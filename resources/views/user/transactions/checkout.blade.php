@extends('layouts.app')

@section('title', 'Checkout')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('header')
    @include('layouts.header')
@endsection

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Checkout</h4>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                        <!-- Adjusted Image with Fixed Size and Responsive Styling -->
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}" style="width: 400px; height: 400px; object-fit: cover;">
                    </div>

                    <div class="col-md-6">
                        <h5>{{ $product->name }}</h5>
                        <p>{{ $product->description }}</p>
                        <h4 class="text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>

                        <!-- Transaction Form -->
                        <form action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_name" value="{{ $product->name }}">
                            <input type="hidden" name="product_price" value="{{ $product->price }}">
                            <input type="hidden" name="product_image" value="{{ $product->image }}">

                            <!-- Customer Details -->
                            <div class="form-group mb-2">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>

                            <div class="form-group mb-2">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            </div>

                            <div class="form-group mb-2">
                                <label for="phone_number">Nomor Telepon</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
                            </div>

                            <div class="form-group mb-2">
                                <label for="payment_proof">Bukti Pembayaran</label>
                                <input type="file" class="form-control" id="payment_proof" name="payment_proof" required>
                            </div>

                            <button type="submit" class="btn btn-outline-primary w-100">Selesaikan Pembelian</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
