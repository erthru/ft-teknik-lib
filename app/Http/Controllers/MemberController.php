<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next){
            if(!$request->session()->get("id")){
                return redirect("/admin/login");
            }

            return $next($request);
        });
    }

    public function member(Request $request)
    {
        return view("admin.member");
    }

    public function dataTableMember(Request $request)
    {
        return Datatables::of(Member::orderBy("id", "DESC")->get())->make();
    }
}
