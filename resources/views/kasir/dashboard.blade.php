@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Kasir Dashboard</h1>

    <div class="row">
        <!-- Transaction Processing -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Process Transaction</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('transactions.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="product_id">Product:</label>
                            <select name="product_id" id="product_id" class="form-control" required>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->nama_produk }} - Rp{{ number_format($product->price, 2, ',', '.') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Transaction</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Daily Sales -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Daily Sales</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @if(isset($dailySales) && $dailySales->count() > 0)
                            @foreach($dailySales as $sale)
                                <li class="list-group-item">
                                    <strong>Transaction ID:</strong> {{ $sale->id }}<br>
                                    <strong>Total Amount:</strong> Rp{{ number_format($sale->total_amount, 2, ',', '.') }}<br>
                                    <strong>Date:</strong> {{ $sale->transaction_date }}<br>
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item">No sales available</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <!-- Manage Receipts -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Manage Receipts</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @if(isset($receipts) && $receipts->count() > 0)
                            @foreach($receipts as $receipt)
                                <li class="list-group-item">
                                    <strong>Receipt ID:</strong> {{ $receipt->id }}<br>
                                    <strong>Transaction ID:</strong> {{ $receipt->transaction_id }}<br>
                                    <strong>Amount:</strong> Rp{{ number_format($receipt->amount, 2, ',', '.') }}<br>
                                    <strong>Date:</strong> {{ $receipt->created_at->format('Y-m-d H:i:s') }}<br>
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item">No receipts available</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
