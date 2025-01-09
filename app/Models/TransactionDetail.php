<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
>>>>>>> 53fdd98df503f6d39e08e0912a7aee6a5d3bcdb9
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
<<<<<<< HEAD
    use HasFactory;

=======
>>>>>>> 53fdd98df503f6d39e08e0912a7aee6a5d3bcdb9
    protected $fillable = [
        'transaction_id',
        'product_id',
        'quantity',
        'unit_price',
<<<<<<< HEAD
        'subtotal',
    ];
=======
        'subtotal'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
>>>>>>> 53fdd98df503f6d39e08e0912a7aee6a5d3bcdb9
}
