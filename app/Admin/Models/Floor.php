<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    //
    protected $table = 'floor';

    public function station()
    {
        return $this->belongsto(Station::class, 'station_id', 'id');
    }
}
