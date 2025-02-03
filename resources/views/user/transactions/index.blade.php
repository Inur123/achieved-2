@extends('layouts.app')

@section('title', 'Pilih Produk untuk Dibeli')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('header')
    @include('layouts.header')
@endsection

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Pilih Produk untuk Dibeli</h4>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            <h6 class="text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</h6>
                            <a href="{{ route('checkout', ['product_id' => $product->id]) }}" class="btn btn-outline-primary w-100">Beli Sekarang</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
