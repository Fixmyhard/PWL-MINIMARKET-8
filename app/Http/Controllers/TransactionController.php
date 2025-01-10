<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter tanggal dari request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Ambil data transaksi berdasarkan filter tanggal
        $transactions = Transaction::with('details.product')
            ->when($startDate, function ($query) use ($startDate) {
                $query->whereDate('transaction_date', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                $query->whereDate('transaction_date', '<=', $endDate);
            })
            ->get();

        // Ambil data detail transaksi berdasarkan filter tanggal
        $transactionDetails = TransactionDetail::with('product')
            ->when($startDate, function ($query) use ($startDate) {
                $query->whereHas('transaction', function ($q) use ($startDate) {
                    $q->whereDate('transaction_date', '>=', $startDate);
                });
            })
            ->when($endDate, function ($query) use ($endDate) {
                $query->whereHas('transaction', function ($q) use ($endDate) {
                    $q->whereDate('transaction_date', '<=', $endDate);
                });
            })
            ->get();

        // Kirim data ke view
        return view('dashboard.manager', compact('transactions', 'transactionDetails', 'startDate', 'endDate'));
    }
}
