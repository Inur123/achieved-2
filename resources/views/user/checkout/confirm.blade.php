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
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded"
                            alt="{{ $product->name }}" style="width: 400px; height: 400px; object-fit: cover;">
                    </div>

                    <div class="col-md-6">
                        <h5>{{ $product->name }}</h5>
                        <p>{{ $product->description }}</p>
                        <h4 class="text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>

                        <!-- Transaction Form -->
                        <button type="button" id="pay-button" class="btn btn-outline-primary w-100">Selesaikan
                            Pembelian</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Midtrans Snap.js -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay('{{ $transaction['snap_token'] }}', {
                onSuccess: function(result) {
                    // Send the result to the server to update the transaction status
                    fetch('/payment-success', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                transaction_id: result.transaction_id, // Pass transaction ID
                                status: 'pending' // Set initial status to pending
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data); // Handle server response
                            // Redirect to the transactions success page
                            window.location.href =
                                '{{ route('checkout.success', ['id' => $transaction->id]) }}';
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                },
                onPending: function(result) {
                    alert("Payment Pending!");
                    console.log(result);
                },
                onError: function(result) {
                    alert("Payment Failed!");
                    console.log(result);
                }
            });
        };
    </script>

@endsection
