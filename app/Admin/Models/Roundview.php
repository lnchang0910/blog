<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Roundview extends Model
{
    protected $table = 'roundview';

    public function station()
    {
        return $this->belongsto(Station::class, 'station_id', 'id');
    }
}
