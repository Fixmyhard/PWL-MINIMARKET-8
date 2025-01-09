<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Product;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Ambil harga produk dari database
        $product = Product::findOrFail($validated['product_id']);
        $unitPrice = $product->price;
        $quantity = $validated['quantity'];
        $subtotal = $unitPrice * $quantity;

        // Simpan ke tabel transactions
        $transaction = Transaction::create([
            'branch_id' => 1, // Asumsi branch_id default, sesuaikan dengan kebutuhan
            'transaction_date' => now(),
            'total_amount' => $subtotal,
        ]);

        // Simpan ke tabel transaction_details
        TransactionDetail::create([
            'transaction_id' => $transaction->id,
            'product_id' => $validated['product_id'],
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'subtotal' => $subtotal,
        ]);

        return redirect()->back()->with('success', 'Transaction successfully saved.');
    }
}
