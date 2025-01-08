<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\StockMovement;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    public function dashboard(Request $request)
    {
        try {
            $startDate = $request->input('start_date', date('Y-m-d'));
            $endDate = $request->input('end_date', date('Y-m-d'));

            // Convert dates to include full day
            $startDateTime = Carbon::parse($startDate)->startOfDay();
            $endDateTime = Carbon::parse($endDate)->endOfDay();

            // Debug the date range
            \Log::info('Date Range:', [
                'start' => $startDateTime->toDateTimeString(),
                'end' => $endDateTime->toDateTimeString()
            ]);

            // Get transaction details
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
                    'transactions.transaction_date as date'
                )
                ->whereBetween('transactions.transaction_date', [$startDateTime, $endDateTime])
                ->orderBy('transactions.transaction_date', 'desc')
                ->get();

            // Debug transactions
            \Log::info('Transactions found: ' . $transactions->count());

            // Get stock movements
            $stocks = DB::table('stock_movements')
                ->join('products', 'stock_movements.product_id', '=', 'products.id')
                ->select(
                    'products.nama_produk',
                    DB::raw('SUM(stock_movements.quantity) as current_stock'),
                    DB::raw('MAX(stock_movements.movement_date) as last_update')
                )
                ->whereBetween('movement_date', [$startDateTime, $endDateTime])
                ->groupBy('products.id', 'products.nama_produk')
                ->get();

            // Get transaction summary
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

            return view('manager.dashboard', compact(
                'transactions',
                'stocks',
                'transactionsSummary',
                'startDate',
                'endDate'
            ));

        } catch (\Exception $e) {
            \Log::error('Manager Dashboard Error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return back()->with('error', 'An error occurred while loading the dashboard.');
        }
    }
}
