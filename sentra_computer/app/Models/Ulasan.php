<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasan';

    protected $fillable = [
        'id_tracking',
        'user_id',
        'nama_pelanggan',
        'rating',
        'ulasan',
        'is_approved'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Servis
    public function servis()
    {
        return $this->belongsTo(Servis::class, 'id_tracking', 'id_tracking');
    }

    // Scope untuk ulasan yang disetujui
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    // Helper untuk mendapatkan stars dalam format array
    public function getStarsAttribute()
    {
        return [
            'filled' => $this->rating,
            'empty' => 5 - $this->rating
        ];
    }
}