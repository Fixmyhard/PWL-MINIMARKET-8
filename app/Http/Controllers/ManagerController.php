<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class ManagerController extends Controller
{
    public function dashboard(Request $request)
    {
        try {
            // Ambil tanggal dari request atau gunakan awal/akhir bulan default
            $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
            $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());

            // Ubah tanggal menjadi datetime untuk query
            $startDateTime = Carbon::parse($startDate)->startOfDay();
            $endDateTime = Carbon::parse($endDate)->endOfDay();

            // Query data transaksi
            $transactions = DB::table('transaction_details')
                ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
                ->join('products', 'transaction_details.product_id', '=', 'products.id')
                ->select(
                    'transaction_details.id',
                    'transaction_details.transaction_id',
                    'transaction_details.quantity',
                    'transaction_details.unit_price',
                    'transaction_details.subtotal',
                    'products.nama_produk as product_name',
                    DB::raw('DATE(transactions.transaction_date) as date')
                )
                ->whereBetween('transactions.transaction_date', [$startDateTime, $endDateTime])
                ->orderBy('transactions.transaction_date', 'desc')
                ->get();

            // Query data stok
            $stocks = DB::table('stock_movements')
                ->join('products', 'stock_movements.product_id', '=', 'products.id')
                ->select(
                    'products.nama_produk',
                    DB::raw('SUM(stock_movements.quantity) as current_stock'),
                    DB::raw('MAX(stock_movements.movement_date) as last_update')
                )
                ->groupBy('products.id', 'products.nama_produk')
                ->get();

            return view('manager.dashboard', compact(
                'transactions',
                'stocks',
                'startDate',
                'endDate'
            ));
        } catch (\Exception $e) {
            \Log::error('Manager Dashboard Error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading the dashboard.');
        }
    }
    public function index(Request $request)
{
    $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
    $endDate = $request->input('end_date', now()->toDateString());

    $startDateTime = \Carbon\Carbon::parse($startDate)->startOfDay();
    $endDateTime = \Carbon\Carbon::parse($endDate)->endOfDay();

    // Query untuk data transaksi
    $transactions = \DB::table('transaction_details')
        ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
        ->join('products', 'transaction_details.product_id', '=', 'products.id')
        ->select(
            'transaction_details.id',
            'transaction_details.transaction_id',
            'transaction_details.quantity',
            'transaction_details.unit_price',
            'transaction_details.subtotal',
            'products.nama_produk as product_name',
            \DB::raw('DATE(transactions.transaction_date) as date')
        )
        ->whereBetween('transactions.transaction_date', [$startDateTime, $endDateTime])
        ->orderBy('transactions.transaction_date', 'desc')
        ->get();

    // Query untuk ringkasan transaksi
    $transactionsSummary = \DB::table('transactions')
        ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
        ->whereBetween('transactions.transaction_date', [$startDateTime, $endDateTime])
        ->select(
            \DB::raw('DATE(transactions.transaction_date) as date'),
            \DB::raw('COUNT(DISTINCT transactions.id) as count'),
            \DB::raw('SUM(transaction_details.subtotal) as total')
        )
        ->groupBy(\DB::raw('DATE(transactions.transaction_date)'))
        ->orderBy('date')
        ->get();

    return view('manager.dashboard', compact('transactions', 'transactionsSummary', 'startDate', 'endDate'));
}


    public function printReport(Request $request)
{
    try {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());

        $startDateTime = Carbon::parse($startDate)->startOfDay();
        $endDateTime = Carbon::parse($endDate)->endOfDay();

        // Query untuk data transaksi
        $transactions = DB::table('transaction_details')
            ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->select(
                'transaction_details.id',
                'transaction_details.transaction_id',
                'transaction_details.quantity',
                'transaction_details.unit_price',
                'transaction_details.subtotal',
                'products.nama_produk as product_name',
                DB::raw('DATE(transactions.transaction_date) as date')
            )
            ->whereBetween('transactions.transaction_date', [$startDateTime, $endDateTime])
            ->orderBy('transactions.transaction_date', 'desc')
            ->get();

        // Query untuk ringkasan transaksi
        $transactionsSummary = DB::table('transactions')
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->whereBetween('transactions.transaction_date', [$startDateTime, $endDateTime])
            ->select(
                DB::raw('DATE(transactions.transaction_date) as date'),
                DB::raw('COUNT(DISTINCT transactions.id) as count'),
                DB::raw('SUM(transaction_details.subtotal) as total')
            )
            ->groupBy(DB::raw('DATE(transactions.transaction_date)'))
            ->orderBy('date')

            ->get();

        // Ambil informasi cabang
        $branch = Auth::user()->branch;

        return view('manager.print-report', compact(
            'transactions',
            'transactionsSummary',
            'startDate',
            'endDate',
            'branch'
        ));
    } catch (\Exception $e) {
        \Log::error('Print Report Error: ' . $e->getMessage());
        return back()->with('error', 'An error occurred while generating the report.');
    }
}
}
