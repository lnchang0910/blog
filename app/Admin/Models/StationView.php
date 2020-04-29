<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class StationView extends Model
{
   protected $table = 'station_view';

   public function station()
   {
      return $this->belongsto(Station::class);
   }
}
