<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'branches'; // Tabel yang digunakan

    protected $fillable = [
        'nama_cabang',
        'alias',
        'telepon',
        'alamat',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'branch_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'branch_id');
    }
}
