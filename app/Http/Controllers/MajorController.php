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
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        return view("admin.major");
    }

    public function majorAdd(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        return view("admin.major_add");
    }

    public function majorAddAction(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        Validator::make($request->all(), [
            'name' => 'required',
        ])->validate();

        $body = [
            "name" => $request->input("name")
        ];

        Major::create($body);

        return redirect("/admin/major")->with("success", "Jurusan ditambahkan.");
    }

    public function majorDetail(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        $major = Major::findOrFail($request->query("id"));
        $data = [
            "major" => $major
        ];

        return view("admin.major_detail", $data);
    }

    public function majorUpdateAction(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        Validator::make($request->all(), [
            'name' => 'required',
        ])->validate();

        $major = Major::findOrFail($request->query("id"));

        $body = [
            "name" => $request->input("name")
        ];

        $major->update($body);

        return redirect("/admin/major")->with("success", "Jurusan diperbarui.");
    }

    public function majorDeleteAction(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        $major = Major::findOrFail($request->query("id"));
        $major->delete();

        return redirect("/admin/major")->with("success", "Jurusan dihapus.");
    }

    public function dataTableMajorJSON(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }
        
        return DataTables::of(Major::get())->make();
    }
}
