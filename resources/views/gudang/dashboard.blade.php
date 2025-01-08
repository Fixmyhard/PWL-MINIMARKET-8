@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Welcome to the Gudang Dashboard</h1>
            <p>Manage inventory, track stock levels, and handle logistics.</p>

            <h2 class="my-4">Stock Movements</h2>
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
                            <td>{{ $movement->product_name }}</td>
                            <td>{{ $movement->quantity }}</td>
                            <td>{{ $movement->movement_type }}</td>
                            <td>{{ $movement->date }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
