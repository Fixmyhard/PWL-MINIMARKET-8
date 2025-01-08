<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);
        $totalAmount = $product->price * $request->quantity;

        $transaction = new Transaction();
        $transaction->customer_name = $request->customer_name;
        $transaction->product_id = $request->product_id;
        $transaction->quantity = $request->quantity;
        $transaction->total_amount = $totalAmount;
        $transaction->transaction_date = now();
        $transaction->save();

        return redirect()->route('dashboard.kasir')->with('success', 'Transaction processed successfully.');
    }
}

