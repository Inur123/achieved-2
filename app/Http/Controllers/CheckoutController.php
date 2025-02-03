<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Midtrans;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function showCheckoutPage($productId)
    {
        // Fetch the product details
        $product = Product::findOrFail($productId);

        // Set the Midtrans server and client keys correctly
        \Midtrans\Config::$serverKey = config('midtrans.server_key');  // Set server key here
        \Midtrans\Config::$clientKey = config('midtrans.client_key');  // Set client key here

        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transactions).
        \Midtrans\Config::$isProduction = config('midtrans.is_production'); // Use the is_production value
        \Midtrans\Config::$isSanitized = true;  // Enable sanitization (default is true)
        \Midtrans\Config::$is3ds = true; // Enable 3DS transaction for credit card payments

        // Prepare the transaction details
        $transactionDetails = [
            'order_id' => 'ORDER-' . uniqid(),
            'gross_amount' => $product->price,  // Amount in IDR
        ];

        // Prepare the item details
        $itemDetails = [
            [
                'id' => $product->id,
                'price' => $product->price,
                'quantity' => 1,
                'name' => $product->name
            ]
        ];

        // Prepare the request parameters
        $params = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails
        ];

        // Generate Snap token
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Create a transaction and store the snap_token
        $transaction = new Transaction();
        $transaction->user_id = auth()->id();
        $transaction->product_id = $product->id;
        $transaction->price = $product->price;
        $transaction->status = 'pending';
        $transaction->snap_token = $snapToken;  // Store the snap_token
        $transaction->save();



        // Pass product and token to the view
        return view('user.checkout.confirm', compact('product', 'snapToken', 'transaction'));
    }




    public function paymentSuccess(Request $request)
    {
        // Capture the Midtrans response from the request
        $transaction_id = $request->transaction_id;  // This will be passed from Midtrans

        // Find the transaction by its snap_token
        $transaction = Transaction::where('snap_token', $transaction_id)->first();

        if ($transaction) {
            // Update the status based on the payment result
            $transaction->status = 'success';  // Set the status to 'paid'
            $transaction->save();  // Save the updated transaction status
        }

        // Redirect to the transaction details page after success
        return view('payment.success', ['transaction' => $transaction]);
    }
}
