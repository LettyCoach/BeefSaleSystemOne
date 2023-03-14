<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class PaginationController extends Controller
{
    
    function index()
    {
     $data = DB::table('markets')->paginate(5);
     return view('pagination', compact('data'));
    }

    function fetch_data(Request $request)
    {
     if($request->ajax())
     {
      $data = DB::table('markets')->paginate(5);
      return view('pagination_data', compact('data'))->render();
     }
    }
}
