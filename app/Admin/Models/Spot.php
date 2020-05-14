<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    //
    protected $table = 'spot';

    public function station()
    {
        return $this->belongsto(Station::class, 'station_id', 'id');
    }
}
