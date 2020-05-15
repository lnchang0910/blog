<?php

namespace App\Admin\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Repositories\AreaModelListsRepository;
use App\Admin\Models\Area;
use Illuminate\Support\Facades\Log;


class AreaQueryModelLists extends Controller
{
   protected $modellistRepo;
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

   public function __construct(AreaModelListsRepository $modellistRepo)
   {
      $this->modellistRepo = $modellistRepo;
   }

   public function index(Request $request)
   {
      $arg = $request->get('arg');
      $result = $this->modellistRepo->areaList($arg);
      Log::info('log info:index');
      return $result;
   }
   /*    public function index(Request $request)
   {
      //return response()->json(['status' => 0, 'posts' => $this->modellistRepo->index()]);
      $q = $request->get('q');
      $rtn = ModelList::where('spec', $q)->pluck('lotnum');
      return $rtn;
   } */

   /**
    * Store a newly created resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      Log::info('log info:store');
      $arg = $request->get('arg');
      $result = $this->modellistRepo->areaStation($arg);
      return $result;
   }

   /**
    * Display the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */

   public function show(Request $request)
   {
      Log::info('log info：show');
      $arg = $request->get('arg');
      //$result = $this->modellistRepo->find($q);
      $result = $this->modellistRepo->areaStation($arg);

      /*
      if (!$result) {
         return response()->json(['status' => 1, 'message' => 'Data not found'], 404);
      }
      return response()->json(['status' => 0, 'lotnum' => $result]);
      */
   }

   /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param int $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
      //
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      //
   }
}
