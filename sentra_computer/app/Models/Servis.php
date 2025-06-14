<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servis extends Model
{
    protected $table = 'servis';
    protected $primaryKey = 'id_tracking';
    public $incrementing = false; // Karena id_tracking bukan auto-increment
    protected $keyType = 'string'; // Karena id_tracking adalah string


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

    /**
     * Relasi dengan MyService
     */
    public function myServices()
    {
        return $this->hasMany(MyService::class, 'id_tracking', 'id_tracking');
    }

    /**
     * Helper function untuk mendapatkan status badge class
     */
    public function getStatusBadgeClass()
    {
        switch ($this->statusservis) {
            case 'Menunggu':
                return 'bg-secondary';
            case 'KonfirmasiBiaya':
                return 'bg-warning';
            case 'Diproses':
                return 'bg-info';
            case 'Selesai':
                return 'bg-success';
            case 'Lunas':
                return 'bg-primary';
            default:
                return 'bg-secondary';
        }
    }

    /**
     * Helper function untuk mendapatkan status text yang readable
     */
    public function getStatusText()
    {
        switch ($this->statusservis) {
            case 'Menunggu':
                return 'Menunggu Konfirmasi';
            case 'KonfirmasiBiaya':
                return 'Konfirmasi Biaya';
            case 'Diproses':
                return 'Sedang Diproses';
            case 'Selesai':
                return 'Selesai';
            case 'Lunas':
                return 'Lunas';
            default:
                return $this->statusservis;
        }
    }

    public function nota()
    {
        return $this->hasOne(Nota::class, 'id_tracking', 'id_tracking');
    }

    // Relasi ke user
    public function pengguna()
    {
        return $this->belongsToMany(User::class, 'my_services', 'id_tracking', 'user_id');
    }
}
