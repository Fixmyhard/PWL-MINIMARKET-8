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
                           value="{{ $startDate ?? request('start_date') }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                           value="{{ $endDate ?? request('end_date') }}">
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
                    @if(isset($transactions) && $transactions->isNotEmpty())
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Subtotal</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->product_name }}</td>
                                        <td>{{ $transaction->quantity }}</td>
                                        <td>{{ $transaction->unit_price }}</td>
                                        <td>{{ $transaction->subtotal }}</td>
                                        <td>{{ $transaction->date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No transactions available.</p>
                    @endif
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
                    @if(isset($stocks) && $stocks->isNotEmpty())
                        <ul class="list-group">
                            @foreach($stocks as $stock)
                                <li class="list-group-item">
                                    <strong>Product:</strong> {{ $stock->nama_produk }}<br>
                                    <strong>Quantity:</strong> {{ $stock->current_stock }}<br>
                                    <strong>Updated At:</strong> {{ $stock->last_update }}<br>
                                    @if($stock->current_stock <= 10)
                                        <span class="text-danger">Low Stock Warning!</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No stocks available.</p>
                    @endif
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
