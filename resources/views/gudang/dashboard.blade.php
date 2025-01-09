@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Gudang Dashboard</h1>

    <div class="row">
        <!-- Stock Movements -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Stock Movements</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Movement Type</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stockMovements as $movement)
                                <tr>
                                    <td>{{ $movement->id }}</td>
                                    <td>{{ $movement->product->nama_produk }}</td>
                                    <td>{{ $movement->jumlah }}</td>
                                    <td>{{ $movement->movement_type }}</td>
                                    <td>{{ $movement->tanggal_perubahan }}</td>
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
