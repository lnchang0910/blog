<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Traffic extends Model
{
    protected $table = 'traffic';

    public function station()
    {
        return $this->belongsto(Station::class, 'station_id', 'id');
    }
}
