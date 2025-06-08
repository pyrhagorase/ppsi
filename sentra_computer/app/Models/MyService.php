<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyService extends Model
{
    protected $table = 'my_services';
    
    protected $fillable = [
        'user_id',
        'id_tracking'
    ];

    public $timestamps = true;

    /**
     * Relasi dengan User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi dengan Servis
     */
    public function servis()
    {
        return $this->belongsTo(Servis::class, 'id_tracking', 'id_tracking');
    }
}