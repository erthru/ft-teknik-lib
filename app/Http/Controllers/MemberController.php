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

    public function addMember(Request $request)
    {
        return view("admin.member_add");
    }

    public function addMemberAction(Request $request)
    {
        Validator::make($request->all(), [
            'nim' => 'required',
            'full_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
        ])->validate();

        $body = [
            "nim" => $request->input("nim"),
            "full_name" => $request->input("full_name"),
            "phone" => $request->input("phone"),
            "address" => $request->input("address"),
            "gender" => $request->input("gender")
        ];

        $check = Member::where("nim", $request->input("nim"))->first();

        if($check){
            return redirect("/admin/member/add")->with("error", "NIM tersebut telah ada.")->withInput();
        }else{
            Member::create($body);
            return redirect("/admin/member")->with("success","Anggota berhasil ditambahkan.");
        }
    }

    public function detailMember(Request $request)
    {
        $member = Member::findOrFail($request->query("id"));

        $data = [
            "member" => $member
        ];

        return view("admin.member_detail", $data);
    }

    public function updateMemberAction(Request $request)
    {
        $member = Member::findOrFail($request->query("id"));

        Validator::make($request->all(), [
            'nim' => 'required',
            'full_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
        ])->validate();

        $body = [
            "nim" => $request->input("nim"),
            "full_name" => $request->input("full_name"),
            "phone" => $request->input("phone"),
            "address" => $request->input("address"),
            "gender" => $request->input("gender")
        ];

        if($request->input("nim") == $member->nim){
            $member->update($body);
            return redirect("/admin/member")->with("success","Anggota berhasil diperbarui.");
        }else{
            $check = Member::where("nim", $request->input("nim"))->first();

            if($check){
                return redirect("/admin/member/detail?id=".$request->query("id"))->with("error", "NIM tersebut telah ada.")->withInput();
            }else{
                $member->update($body);
                return redirect("/admin/member")->with("success","Anggota berhasil diperbarui.");
            }
        }
    }

    public function deleteMemberAction(Request $request)
    {
        $member = Member::findOrFail($request->query("id"));
        $member->delete();

        return redirect("/admin/member")->with("success","Anggota berhasil dihapus.");
    }

    public function dataTableMember(Request $request)
    {
        return Datatables::of(Member::orderBy("id", "DESC")->get())->make();
    }
}
