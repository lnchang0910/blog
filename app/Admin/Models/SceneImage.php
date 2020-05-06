<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class SceneImage extends Model
{
    //
    protected $table = 'scenery_image' ;

    public function station()
    {
        return $this->belongsto(Station::class, 'station_id', 'id');
    }

    public function scenery()
    {
        return $this->belongsto(Scenery::class);
    }
}
