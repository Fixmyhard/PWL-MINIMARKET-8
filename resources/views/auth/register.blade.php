@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Register User</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group mb-3">
            <label for="nama_user">Name:</label>
            <input type="text" name="nama_user" id="nama_user" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="role">Role:</label>
            <select name="peran" id="role" class="form-control" required>
                <option value="owner">Owner</option>
                <option value="manager">Manager</option>
                <option value="supervisor">Supervisor</option>
                <option value="kasir">Kasir</option>
                <option value="gudang">Gudang</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="id_cabang">Branch (Optional):</label>
            <select name="id_cabang" id="id_cabang" class="form-control">
                <option value="">None</option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->nama_cabang }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
@endsection
