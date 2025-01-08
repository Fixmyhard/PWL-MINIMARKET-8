<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Transaction;
use App\Models\Stock;

class OwnerDashboardController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        $transactions = Transaction::all();
        $stocks = Stock::all();

        return view('owner.dashboard', compact('branches', 'transactions', 'stocks'));
    }
}
