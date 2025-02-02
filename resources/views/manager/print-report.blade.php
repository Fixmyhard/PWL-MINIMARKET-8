<!DOCTYPE html>
<html>
<head>
    <title>Report {{ $startDate }} to {{ $endDate }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .branch-info {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .section {
            margin-bottom: 30px;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Manager Report</h1>
        <h3>Period: {{ $startDate }} to {{ $endDate }}</h3>
    </div>

    <div class="branch-info">
        <h4>Branch:
            {{ Auth::user()->branch ? Auth::user()->branch->nama_cabang : 'No branch assigned' }}
        </h4>
    </div>

    <div class="section">
        <h2>Transaction Summary</h2>
        @if(isset($transactionsSummary) && $transactionsSummary->isNotEmpty())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Number of Transactions</th>
                        <th>Total Sales</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactionsSummary as $summary)
                        <tr>
                            <td>{{ $summary->date }}</td>
                            <td>{{ $summary->count }}</td>
                            <td>Rp{{ number_format($summary->total, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No transaction summary available for the selected date range.</p>
        @endif
    </div>


    <button class="no-print" onclick="window.print()">Print Report</button>
</body>
</html>
