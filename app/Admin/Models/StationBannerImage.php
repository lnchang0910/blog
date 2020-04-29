<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class StationBannerImage extends Model
{
   protected $table = 'station_banner_image';

   public function station()
   {
      return $this->belongsto(Station::class);
   }
}
