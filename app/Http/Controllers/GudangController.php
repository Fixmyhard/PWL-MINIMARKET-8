<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    // Show all products and stock
    public function index()
    {
        $products = Product::all();
        $stockMovements = StockMovement::with('product')->get(); // Use StockMovement instead of Stock
        $stock = Stock::with('product')->get();
        return view('gudang.dashboard', compact('products', 'stockMovements'));
    }

    // Show the form to create a new product
    public function create()
    {
        return view('gudang.create');
    }

    // Store a new product
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255', // Pastikan nama produk tidak kosong dan sesuai tipe
            'harga_produk' => 'required|numeric|min:0', // Pastikan harga produk adalah angka
            'quantity' => 'required|integer|min:1', // Validasi jumlah stok awal
        ]);

        // Menyimpan produk baru ke dalam tabel
        $product = Product::create([
            'nama_produk' => $validated['nama_produk'],  // Simpan nama produk
            'harga_produk' => $validated['harga_produk'], // Simpan harga produk
        ]);

        // Menyimpan stok awal ke dalam tabel stocks
        Stock::create([
            'product_id' => $product->id,
            'quantity' => $validated['quantity'],
            'branch_id' => 1, // Set branch_id to 1
        ]);

        // Menyimpan pergerakan stok ke dalam tabel stock_movements
        StockMovement::create([
            'id_produk' => $product->id,
            'jumlah' => $validated['quantity'],
            'id_cabang' => 1, // Set id_cabang to 1
            'user_id' => auth()->id(), // Set user_id to the authenticated user
            'movement_type' => 'in', // Set movement type to "in"
            'tanggal_perubahan' => now(), // Set the current date
        ]);

        // Redirect setelah berhasil
        return redirect()->route('gudang.dashboard')->with('success', 'Product and initial stock added successfully!');
    }

    // Show the form to add stock for a product
    public function addStockForm($productId)
    {
        $product = Product::findOrFail($productId);
        return view('gudang.addStock', compact('product'));
    }

    // Store stock for a product
    public function addStock(Request $request, $productId)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
            // Remove branch_id validation as it's set automatically
        ]);

        Stock::create([
            'product_id' => $productId,
            'quantity' => $validated['quantity'],
            'branch_id' => 1, // Automatically set branch_id to 1
        ]);

        // Menyimpan pergerakan stok ke dalam tabel stock_movements
        StockMovement::create([
            'id_produk' => $productId,
            'jumlah' => $validated['quantity'],
            'id_cabang' => 1, // Set id_cabang to 1
            'user_id' => auth()->id(), // Set user_id to the authenticated user
            'movement_type' => 'in', // Set movement type to "in"
            'tanggal_perubahan' => now(), // Set the current date
        ]);

        return redirect()->route('gudang.dashboard')->with('success', 'Stock added successfully!');
    }

    public function delete($id)
    {
        $movement = StockMovement::findOrFail($id);
        $movement->delete();

        // Also delete the stock movement by movement_type
        StockMovement::where('id', $id)->delete();

        return redirect()->route('gudang.dashboard')->with('success', 'Stock movement deleted successfully');
    }
}
