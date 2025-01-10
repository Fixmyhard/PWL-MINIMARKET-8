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
                           value="{{ $startDate }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                           value="{{ $endDate }}">
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

    <!-- Transactions Summary Card -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Transaction Summary</h2>
                </div>
                <div class="card-body">
                    @if($transactionsSummary->isNotEmpty())
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Number of Transactions</th>
                                    <th>Total Sales</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactionsSummary as $summary)
                                    <tr>
                                        <td>{{ $summary->date }}</td>
                                        <td>{{ $summary->count }}</td>
                                        <td>Rp{{ number_format($summary->total, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No transactions summary available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions Details Card -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Transaction Details</h2>
                </div>
                <div class="card-body">
                    @if($transactions->isNotEmpty())
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->transaction_id }}</td>
                                        <td>{{ $transaction->date }}</td>
                                        <td>{{ $transaction->product_name }}</td>
                                        <td>{{ $transaction->quantity }}</td>
                                        <td>Rp{{ number_format($transaction->unit_price, 2, ',', '.') }}</td>
                                        <td>Rp{{ number_format($transaction->subtotal, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No transaction details available.</p>
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
