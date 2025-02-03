{{-- resources/views/payment/success.blade.php --}}

@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('header')
    @include('layouts.header')
@endsection
<div class="container-fluid">
    <h1>Transaction Details</h1>

    <div class="card mt-4">
        <div class="card-header">
            Transaction #{{ $transaction->id }}
        </div>
        <div class="card-body">
            <p><strong>Order ID:</strong> {{ $transaction->order_id }}</p>
            <p><strong>Product:</strong> {{ $transaction->product->name }}</p>
            <p><strong>Price:</strong> Rp {{ number_format($transaction->price, 0, ',', '.') }}</p>
            <p><strong>Status:</strong>
                @if($transaction->status === 'paid')
                    <span class="badge badge-success">Paid</span>
                @elseif($transaction->status === 'pending')
                    <span class="badge badge-warning">Pending</span>
                @elseif($transaction->status === 'approved')
                    <span class="badge badge-info">Approved</span>
                @else
                    <span class="badge badge-danger">Failed</span>
                @endif
            </p>
            <p><strong>Transaction Date:</strong> {{ $transaction->created_at->format('d M Y, H:i') }}</p>

            <a href="" class="btn btn-primary mt-3">Go to Home</a>
        </div>
    </div>
</div>
@endsection
