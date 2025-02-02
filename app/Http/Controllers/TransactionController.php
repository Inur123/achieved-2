<?php

// app/Http/Controllers/TransactionController.php
namespace App\Http\Controllers;

use App\Models\Product;


use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\ProductTransaction;

class TransactionController extends Controller
{

    public function index()
    {
        // Ambil transaksi yang dimiliki oleh user yang sedang login
        $transactions = Transaction::where('user_id', auth()->id())->get();

        // Kirim data transaksi ke view
        return view('user.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::where('status', true)->get();
        return view('user.transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        // Validasi input selain quantity karena kita tidak akan memerlukan itu
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:15',
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Menyimpan bukti pembayaran ke storage/public
        $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Menyimpan transaksi
        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'product_id' => $validated['product_id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'payment_proof' => $paymentProofPath,
        ]);

        // Cek apakah produk sudah ada di product_transaction
        $productTransaction = ProductTransaction::where('product_id', $validated['product_id'])
                                                ->latest()
                                                ->first();

        if ($productTransaction) {
            // Jika produk sudah ada, tambahkan quantity
            $productTransaction->increment('quantity');
        } else {
            // Jika produk belum ada, buat entri baru dengan quantity 1
            ProductTransaction::create([
                'product_id' => $validated['product_id'],
                'transaction_id' => $transaction->id,
                'quantity' => 1,
            ]);
        }

        // Redirect ke halaman transaksi dengan pesan sukses
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dibuat.');
    }

    public function checkout($product_id)
    {
        $product = Product::findOrFail($product_id);
        return view('user.transactions.checkout', compact('product'));
    }

     // Generate Invoice for Approved Transaction
     public function generateInvoice($transaction_id)
     {
         $transaction = Transaction::findOrFail($transaction_id);

         // Ensure the transaction status is "approved" before generating the invoice
         if ($transaction->status !== 'approved') {
             return redirect()->route('transactions.index')->with('error', 'Transaksi belum disetujui.');
         }

         // Instantiate the PDF facade and load the view
         $pdf = Pdf::loadView('user.transactions.invoice', compact('transaction'));

         // Stream the PDF to the browser (this will display the PDF inline)
         return $pdf->stream('invoice_' . $transaction->id . '.pdf');
     }


}
