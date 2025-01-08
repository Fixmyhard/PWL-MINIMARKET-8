@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Manager Dashboard</h1>

    <!-- Date Filter Form -->
    <form method="GET" action="{{ route('dashboard.manager') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" 
                           value="{{ request('start_date') }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" 
                           value="{{ request('end_date') }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <button type="button" class="btn btn-success" onclick="printReport()">Print Report</button>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <!-- Transactions Card -->
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

        <!-- Stocks Card -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Stock Status</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @if(isset($stocks) && $stocks->count() > 0)
                            @foreach($stocks as $stock)
                                <li class="list-group-item">
                                    <strong>Product:</strong> {{ $stock->product->nama_produk }}<br>
                                    <strong>Quantity:</strong> {{ $stock->quantity }}<br>
                                    <strong>Updated At:</strong> {{ $stock->updated_at->format('Y-m-d H:i:s') }}<br>
                                    @if($stock->quantity <= 10)
                                        <span class="text-danger">Low Stock Warning!</span>
                                    @endif
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

<!-- Print Script -->
<script>
function printReport() {
    const startDate = document.getElementById('start_date').value;
    const endDate = document.getElementById('end_date').value;
    
    if (!startDate || !endDate) {
        alert('Please select both start and end dates');
        return;
    }

    // Open print window with filtered data
    window.open(`/manager/print-report?start_date=${startDate}&end_date=${endDate}`, '_blank');
}
</script>
@endsection
