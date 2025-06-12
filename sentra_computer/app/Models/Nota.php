<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    // Menentukan kolom yang bisa diisi secara massal
    protected $fillable = [
        'id_tracking',
        'tanggal',
        'kasir',
        'status',
        'metode_bayar',
        'total',
        'dibayar',
        'kembalian',
    ];

    public function items()
    {
        return $this->hasMany(NotaItem::class);
    }
}
