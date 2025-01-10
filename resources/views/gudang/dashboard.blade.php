@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Gudang Dashboard</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Stock Movements</h2>
                    <a href="{{ route('gudang.create') }}" class="btn btn-primary">Add New Product</a>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Movement Type</th> <!-- Add Movement Type column -->
                                    <th>Date</th>
                                    <th>Action</th>  <!-- Kolom baru untuk tombol delete -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stockMovements as $movement)
                                <tr>
                                    <td>{{ $movement->id }}</td>
                                    <td>{{ $movement->product->nama_produk }}</td>
                                    <td>{{ $movement->jumlah }}</td>
                                    <td>{{ $movement->movement_type }}</td> <!-- Display Movement Type -->
                                    <td>{{ $movement->created_at }}</td>
                                    <td>
                                        <!-- Tombol Delete -->
                                        <form action="{{ route('gudang.delete', $movement->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                   
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
