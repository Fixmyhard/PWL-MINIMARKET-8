<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard Pemilik</h1>

    <!-- Form untuk memilih cabang -->
    <form method="GET" action="{{ route('dashboard') }}">
        <label for="branch">Pilih Cabang:</label>
        <select name="branch" id="branch">
            @foreach ($branches as $branch)
                <option value="{{ $branch->id }}" {{ request('branch') == $branch->id ? 'selected' : '' }}>
                    {{ $branch->alias }}
                </option>
            @endforeach
        </select>
        <button type="submit">Lihat Dashboard</button>
    </form>

    <!-- Detail cabang -->
    @if ($selectedBranch)
        <h2>Detail Cabang: {{ $selectedBranch->alias }}</h2>
        <p>Nama Cabang: {{ $selectedBranch->nama_cabang }}</p>
        <p>Alamat: {{ $selectedBranch->alamat }}</p>
        <p>Telepon: {{ $selectedBranch->telepon ?? 'Tidak tersedia' }}</p>
    @else
        <p>Pilih cabang untuk melihat detailnya.</p>
    @endif

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-dropdown-link :href="route('logout')"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-dropdown-link>
    </form>
</body>
</html>
