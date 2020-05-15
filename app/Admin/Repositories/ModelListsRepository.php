<?php

namespace App\Admin\Repositories;

use App\Admin\Models\ModelList;
use Illuminate\Database\Eloquent\Model;

class ModelListsRepository
{
   protected $modellistRepo;

   public function __construct(ModelList $modellistRepo)
   {
      $this->modellistRepo = $modellistRepo;
   }

   public function areaName($qry)
   {
      $result = ModelList::where('id', $qry)->pluck('area_name');
      return $result;
   }

}
