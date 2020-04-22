<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
   protected $table = 'station';

   public function area()
   {
      return $this->belongsto(Area::class);
   }
}
