<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Selfdrive extends Model
{
    protected $table = 'self_drive';

    public function station()
    {
        return $this->belongsto(Station::class, 'station_id', 'id');
    }
}
