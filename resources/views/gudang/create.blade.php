@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Add New Product</h1>

    <form action="{{ route('gudang.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_produk">Product Name</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
        </div>
        <div class="form-group">
            <label for="harga_produk">Price</label>
            <input type="number" class="form-control" id="harga_produk" name="harga_produk" required>
        </div>
        <div class="form-group">
            <label for="quantity">Initial Stock Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Add Product</button>
    </form>
</div>
@endsection
