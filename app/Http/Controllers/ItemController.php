<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {

    }

    public function add(Request $request)
    {
        return view("admin.add_book");
    }
    
    public function addAction(Request $request)
    {
        dd($request);
    }
}
