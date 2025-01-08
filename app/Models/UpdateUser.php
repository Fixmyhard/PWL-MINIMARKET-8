<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UpdateUser extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $table = 'update_users'; // Tabel yang digunakan
    public $timestamps = false;

    protected $fillable = [
        'nama_user',
        'peran',
        'email',
        'password',
        'id_cabang',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function cabang()
    {
        return $this->belongsTo(Branch::class, 'id_cabang');
    }

    public function getRoleAttribute()
    {
        return $this->attributes['peran'];
    }
}
