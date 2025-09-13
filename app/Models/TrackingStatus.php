<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingStatus extends Model
{
    public function trackings()
    {
        return $this->hasMany(Tracking::class);
    }
}
