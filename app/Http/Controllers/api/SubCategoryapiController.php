<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryapiController extends Controller
{
  public function index()
    {
        $subcategories = SubCategory::all();
        return response()->json($subcategories);
    }
}
