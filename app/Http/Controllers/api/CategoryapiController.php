<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryapiController extends Controller
{
  public function index()
    {
        $categories = Category::all(); // استرجاع جميع الفئات من قاعدة البيانات
        return response()->json($categories); // إرجاع البيانات بتنسيق JSON
    }
}
