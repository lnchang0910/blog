<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Scenery extends Model
{
    protected $table = 'scenery';

    public function station()
    {
        return $this->belongsto(Station::class, 'station_code', 'id');
    }
}
