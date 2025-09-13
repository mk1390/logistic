<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengirimanAgent extends Model
{
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function pengirimanBarang()
    {
        return $this->belongsTo(PengirimanBarang::class);
    }
}
