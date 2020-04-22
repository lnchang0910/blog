<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
   protected $table = 'area';

   public function station()
   {
      return $this->hasOne(Station::class);
   }
}
