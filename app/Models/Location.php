<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function location()
    {
        return $this->belongsTo(\App\Custom\Models\Location::class);
    }
}
