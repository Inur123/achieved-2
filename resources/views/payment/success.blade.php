{{-- resources/views/payment/success.blade.php --}}

@extends('layouts.app')

@section('title', 'Pembayaran Sukses')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('header')
    @include('layouts.header')
@endsection

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Pembayaran Sukses</h4>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-success">Terima Kasih, Pembayaran Anda Telah Berhasil!</h5>
                        <p class="card-text">Transaksi Anda telah berhasil diproses. Kami akan segera mengirimkan konfirmasi pembelian ke email Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
