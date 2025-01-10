<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Stock;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function index()
    {
        $transactions = Transaction::orderBy('transaction_date', 'desc')
            ->take(10)
            ->get();

        $stocks = Stock::with('product')
            ->where('quantity', '<=', 10)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('supervisor.dashboard', compact('transactions', 'stocks'));
    }

}

