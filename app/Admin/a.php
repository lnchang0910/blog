<?php

namespace App\Admin\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ModellistsRepository;
use Illuminate\Support\Facades\DB;
use App\Modellist;
use Illuminate\Support\Facades\Log;


class QueryModellists extends Controller
{
   protected $modellistRepo;
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

   public function __construct(ModellistsRepository $modellistRepo)
   {
      $this->modellistRepo = $modellistRepo;
   }

   public function index(Request $request)
   {
      //return response()->json(['status' => 0, 'posts' => $this->modellistRepo->index()]);
      $q = $request->get('q');
      $rtn = Modellist::where('spec', $q)->pluck('lotnum');
      return $rtn;
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      //
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
      $modellist = $this->modellistRepo->find($q);
      if (!$modellist) {
         return response()->json(['status' => 1, 'message' => 'Data not found'], 404);
      }
      return response()->json(['status' => 0, 'lotnum' => $modellist]);
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
