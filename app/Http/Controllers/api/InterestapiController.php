<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Interest;
use Illuminate\Http\Request;

class InterestapiController extends Controller
{
   function store(Request $request){
    $interst=new Interest();
    $interst->user_id=$request->input('user_id');
    $interst->subcategory_id=$request->input('subcategory_id');
    if( $interst->save()){

        return ['status'=>'data has been inserted'];


   }
}
}
