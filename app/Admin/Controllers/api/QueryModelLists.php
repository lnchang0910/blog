<?php

namespace App\Admin\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Repositories\ModelListsRepository;
use App\Admin\Models\ModelList;
use Illuminate\Support\Facades\Log;


class QueryModelLists extends Controller
{
   protected $modellistRepo;
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

   public function __construct(ModelListsRepository $modellistRepo)
   {
      $this->modellistRepo = $modellistRepo;
   }

   public function index(Request $request)
   //public function index()
   {
      $arg = $request->get('arg');
      $arg = 1;
      $result = $this->modellistRepo->areaName($arg);
      Log::info('log info');
      return $result;
      //print_r($result);
      //var_dump($result);
      //return $result;
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
      $arg = $request->get('arg');
      $arg = 2;
      $result = $this->modellistRepo->areaName($arg);
      //print_r($result);
      //var_dump($result);
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
      $q = $request->get('q');
      //$result = $this->modellistRepo->find($q);
      $result = $this->modellistRepo->areaName($q);

      if (!$result) {
         return response()->json(['status' => 1, 'message' => 'Data not found'], 404);
      }
      return response()->json(['status' => 0, 'lotnum' => $result]);
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
