@extends('layouts.app')

@section('title', 'Dashboard')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('header')
    @include('layouts.header')
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Row 1 -->
        <div class="row">
            <!-- Total Transactions Card -->
            <h1>Welcome, {{ Auth::user()->name }}!</h1>
            <div class="col-md-4">
                <a href="{{ route('transactions.index') }}" class="card shadow-sm text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title">Total Transactions</h5>
                        <p class="card-text">{{ number_format($totalTransactions) }} Transactions</p>
                    </div>
                </a>
            </div>

            <!-- Total Payments Card -->
            <div class="col-md-4">
                <a href="{{ route('transactions.index') }}" class="card shadow-sm text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title">Total Payments</h5>
                        <p class="card-text">Rp {{ number_format($totalPayments, 0, ',', '.') }}</p>
                    </div>
                </a>
            </div>
            <!-- Placeholder Card (can be replaced later) -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Placeholder</h5>
                        <p class="card-text">This section can be used for future data.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection
