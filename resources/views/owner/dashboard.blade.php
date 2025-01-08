@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Owner Dashboard</h1>

    <!-- Dropdown untuk memilih cabang -->
    <form method="GET" action="{{ route('dashboard.owner') }}" id="branchFilterForm">
        <div class="form-group mb-4">
            <label for="branch">Select Branch:</label>
            <select name="branch" id="branch" class="form-control" onchange="document.getElementById('branchFilterForm').submit();">
                <option value="">All Branches</option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}" {{ $selectedBranch && $selectedBranch->id == $branch->id ? 'selected' : '' }}>
                        {{ $branch->nama_cabang }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <div class="row">
        <!-- Transaksi -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Transactions</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @if(isset($transactions) && $transactions->count() > 0)
                            @foreach($transactions as $transaction)
                                <li class="list-group-item">
                                    <strong>Transaction ID:</strong> {{ $transaction->id }}<br>
                                    <strong>Total Amount:</strong> Rp{{ number_format($transaction->total_amount, 2, ',', '.') }}<br>
                                    <strong>Branch:</strong> {{ $transaction->branch->nama_cabang }}<br>
                                    <strong>Date:</strong> {{ $transaction->transaction_date }}<br>
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item">No transactions available</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <!-- Stok -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Stocks</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @if(isset($stocks) && $stocks->count() > 0)
                            @foreach($stocks as $stock)
                                <li class="list-group-item">
                                    <strong>Product:</strong> {{ $stock->product->nama_produk }}<br>
                                    <strong>Quantity:</strong> {{ $stock->quantity }}<br>
                                    <strong>Branch:</strong> {{ $stock->branch->nama_cabang }}<br>
                                    <strong>Updated At:</strong> {{ $stock->updated_at->format('Y-m-d H:i:s') }}<br>
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item">No stocks available</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
