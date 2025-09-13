<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $fillable = [
        'pengiriman_barang_id',
        'tracking_status_id',
        'nama_status',
    ];

    public function pengirimanBarang()
    {
        return $this->belongsTo(PengirimanBarang::class, 'pengiriman_barang_id');
    }

    public function trackingStatus()
    {
        return $this->belongsTo(TrackingStatus::class);
    }
}
