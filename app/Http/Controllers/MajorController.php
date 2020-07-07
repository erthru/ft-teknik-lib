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

    public function majorAdd(Request $request)
    {
        return view("admin.major_add");
    }

    public function majorAddAction(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
        ])->validate();

        $body = [
            "name" => $request->input("name")
        ];

        Major::create($body);

        return redirect("/admin/major")->with("success", "Jurusan ditambahkan.");
    }

    public function dataTableMajor()
    {
        return DataTables::of(Major::get())->make();
    }
}
