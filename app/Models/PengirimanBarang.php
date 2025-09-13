<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class PengirimanBarang extends Model
{
    //protected
    protected $casts = [
        'tanggal_estimasi_diterima' => 'date',
        'tanggal_kirim' => 'date',  
    ];
    
    
    //relasi

    public function layanan()
    {
        return $this->belongsTo(layanan::class, 'layanan_id');
    }

    public function customer()
    {
        return $this->belongsTo(customer::class, 'perusahaan_id');
    }

    public function kotaPengirim()
    {
        return $this->belongsTo(KotaKabupaten::class, 'kota_pengirim_id');
    }

    public function kotaPenerima()
    {
        return $this->belongsTo(KotaKabupaten::class, 'kota_penerima_id');
    }

    public function jenisbarang()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang_id');
    }

    public function pelindungbarang()
    {
        return $this->belongsTo(PelindungBarang::class, 'pelindung_barang_id');
    }

    public function pengirimanAgents()
    {
        return $this->hasMany(PengirimanAgent::class);
    }

    //hitung harga
    public function hitungTotalHarga(): float
    {
        return collect([
            $this->harga_kirim,
            $this->harga_asuransi,
            $this->harga_bongkar,
            $this->harga_lainnya,
        ])->map(fn($val) => floatval(preg_replace('/[^\d.]/', '', $val ?? '0')))->sum();
    }

    public function trackings()
    {
        return $this->hasMany(Tracking::class);
    }
}
