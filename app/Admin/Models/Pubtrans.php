<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Pubtrans extends Model
{
    protected $table = 'public_transportation';

    public function station()
    {
        return $this->belongsto(Station::class, 'station_id', 'id');
    }
}
