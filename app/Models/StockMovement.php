<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $fillable = [
        'id_cabang',
        'id_produk',  
        'user_id',    
        'movement_type',
        'jumlah',     
        'deskripsi',  
        'tanggal_perubahan',
    ];

    protected $dates = ['tanggal_perubahan'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id'); 
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); 
    }
}
