<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input, textarea, button {
            padding: 10px;
            width: 100%;
            margin-top: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Tambah Cabang Baru</h1>
    <form method="POST" action="{{ route('branch.store') }}">
        @csrf
        <label for="nama_cabang">Nama Cabang</label>
        <input type="text" id="nama_cabang" name="nama_cabang" required>

        <label for="alias">Alias</label>
        <input type="text" id="alias" name="alias" required>

        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat" required></textarea>

        <label for="telepon">Telepon</label>
        <input type="text" id="telepon" name="telepon">

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
