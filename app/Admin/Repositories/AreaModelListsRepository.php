<?php

namespace App\Admin\Repositories;

use App\Admin\Models\Area;
use App\Admin\Models\Station;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AreaModelListsRepository
{
   protected $modellistRepo;

   public function __construct(Area $modellistRepo)
   {
      $this->modellistRepo = $modellistRepo;
   }

   public function areaList($qry)
   {
      $area = Area::all()->pluck('area_name', 'id');
      /*
      $sql = "SELECT A.area_name, S.station_name FROM `area` A LEFT JOIN `station` S ON A.`id`=S.`area_id` WHERE A.`id`='".$qry."'";
      $result = DB::select($sql);
      return $result;
      */
      return $area;
   }

   public function areaStation($qry)
   {
      $area = Area::where('id', $qry)->pluck('area_name', 'id');
      $station = Station::where('area_id', $qry)->where('valid_at', '>', now())->pluck('station_name', 'id');
      /*
      $sql = "SELECT A.area_name, S.station_name FROM `area` A LEFT JOIN `station` S ON A.`id`=S.`area_id` WHERE A.`id`='".$qry."'";
      $result = DB::select($sql);
      return $result;
      */
      return response()->json(['area' => $area, 'station' => $station]);
   }

}
