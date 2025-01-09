<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Receipt;

class KasirController extends Controller
{
    public function dashboard()
    {
        $products = Product::all();
        $dailySales = Transaction::whereDate('created_at', now()->toDateString())->get();
        $receipts = Receipt::all();

        return view('kasir.dashboard', compact('products', 'dailySales', 'receipts'));
    }
}
