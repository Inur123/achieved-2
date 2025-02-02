<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $transaction->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .invoice-header img {
            height: 50px;
        }

        .invoice-header h1 {
            font-size: 28px;
            color: #333;
            margin: 0;
        }

        .invoice-details p {
            font-size: 14px;
            margin: 5px 0;
        }

        .invoice-items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-items th,
        .invoice-items td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .invoice-items th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .total {
            text-align: right;
            font-size: 20px;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: #555;
        }

        .footer p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="invoice-header">
            <!-- Add Logo -->
            <img src="{{ public_path('template/assets/images/logos/logo-invoice.png') }}" alt="Logo" style="width: 50%; height: auto;">


            <div>
                <h1>Invoice #{{ $transaction->id }}</h1>
                <p>Tanggal Transaksi: {{ now()->translatedFormat('l, d F Y \p\u\k\u\l H.i.s') }}</p>

            </div>
        </div>

        <div class="invoice-details">
            <p><strong>Name:</strong> {{ $transaction->name }}</p>
            <p><strong>Email:</strong> {{ $transaction->email }}</p>
            <p><strong>No Hp:</strong> {{ $transaction->phone_number }}</p>
        </div>

        <table class="invoice-items">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $transaction->product->name }}</td>
                    <td>Rp {{ number_format($transaction->product->price, 0, ',', '.') }}</td>
                    <td>1</td>
                    <td>Rp {{ number_format($transaction->product->price, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="total">
            <h3>Total: Rp {{ number_format($transaction->product->price, 0, ',', '.') }}</h3>
        </div>

        <div class="footer">
            <p>Thank you for your purchase!</p>
            <p>Achieved.id</p>
        </div>
    </div>
</body>

</html>
