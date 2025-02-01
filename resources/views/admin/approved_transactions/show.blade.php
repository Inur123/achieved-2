<!-- resources/views/admin/approved_transactions/show.blade.php -->

@extends('layouts.app')
@section('title', 'Detail Transaksi')
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('header')
    @include('layouts.header')
@endsection
@section('content')
    {{-- Toast Notification --}}
    <div id="toastContainer" style="position: fixed; top: 10px; right: 10px; z-index: 1050;">
        @if ($errors->any())
            <div class="toast align-items-center text-white bg-danger border-0 show" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="toast align-items-center text-white bg-danger border-0 show" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="toast align-items-center text-white bg-success border-0 show" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif
    </div>

    {{-- Content --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h4 class="mb-3">Detail Transaksi</h4>

                <div class="card">
                    <div class="card-body">
                        <p><strong>ID Transaksi:</strong> {{ $transaction->id }}</p>
                        <p><strong>Nama:</strong> {{ $transaction->name }}</p>
                        <p><strong>Email:</strong> {{ $transaction->email }}</p>
                        <p><strong>Produk:</strong> {{ $transaction->product->name }}</p>
                        <p><strong>Status:</strong> {{ $transaction->status }}</p>
                        <p><strong>Catatan Approval:</strong> {{ $transaction->approval_notes }}</p>

                        @if ($transaction->status === 'pending')
                            <form action="{{ route('approved_transactions.approve', $transaction->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-success">Approve</button>
                            </form>
                        @else
                            <span class="badge bg-success">Approved</span>
                        @endif


                    </div>

                </div>
                <div class="card-footer">
                    <a href="{{ route('approved_transactions.index') }}" class="btn btn-outline-secondary w-auto">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
