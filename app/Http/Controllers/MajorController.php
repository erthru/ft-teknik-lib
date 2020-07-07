<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Major;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MajorController extends Controller
{
    public function major(Request $request)
    {
        return view("admin.major");
    }

    public function dataTableMajor()
    {
        return DataTables::of(Major::get())->make();
    }
}
