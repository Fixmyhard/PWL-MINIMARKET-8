<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'total_amount',
        'total_products',
        'transaction_date',
    ];

    // Relasi dengan tabel Branch (untuk cabang)
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    // Relasi dengan tabel User jika ingin mencatat pengguna yang melakukan transaksi
    public function user()
    {
        return $this->belongsTo(UpdateUser::class, 'user_id');
    }
}
