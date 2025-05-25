<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servis extends Model
{
    protected $table = 'servis';

    protected $fillable = [
        'id_tracking',
        'nama_pelanggan',
        'kontak',
        'waktu_servis',
        'tipe_barang',
        'kerusakan',
        'biaya',
        'status_pembayaran',
        'keterangan',
        'statusservis',
    ];

    public $timestamps = true;
}
