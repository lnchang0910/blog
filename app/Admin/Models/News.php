<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    public function station()
    {
        return $this->belongsto(Station::class);
    }
}
