<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Major;
use App\StudyProgram;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Milon\Barcode\Facades\DNS1DFacade;

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

    public function memberAdd(Request $request)
    {
        $majors = Major::get();

        $data = [
            "majors" => $majors,
        ];

        return view("admin.member_add", $data);
    }

    public function memberAddAction(Request $request)
    {
        Validator::make($request->all(), [
            'nim' => 'required',
            'full_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'major_id' => 'required',
            'study_program_id' => 'required'
        ])->validate();

        $body = [
            "nim" => $request->input("nim"),
            "full_name" => $request->input("full_name"),
            "phone" => $request->input("phone"),
            "address" => $request->input("address"),
            "gender" => $request->input("gender"),
            "major_id" => $request->input("major_id"),
            "study_program_id" => $request->input("study_program_id")
        ];

        $check = Member::where("nim", $request->input("nim"))->first();

        if($check){
            return redirect("/admin/member/add")->with("error", "NIM tersebut telah ada.")->withInput();
        }else{
            Member::create($body);
            return redirect("/admin/member")->with("success","Anggota berhasil ditambahkan.");
        }
    }

    public function memberDetail(Request $request)
    {
        $member = Member::findOrFail($request->query("id"));

        $majors = Major::get();
        $studyPrograms = StudyProgram::where("major_id", $member->major_id)->get();

        $data = [
            "member" => $member,
            "majors" => $majors,
            "studyPrograms" => $studyPrograms
        ];

        return view("admin.member_detail", $data);
    }

    public function memberUpdateAction(Request $request)
    {
        $member = Member::findOrFail($request->query("id"));

        Validator::make($request->all(), [
            'nim' => 'required',
            'full_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'major_id' => 'required',
            'study_program_id' => 'required'
        ])->validate();

        $body = [
            "nim" => $request->input("nim"),
            "full_name" => $request->input("full_name"),
            "phone" => $request->input("phone"),
            "address" => $request->input("address"),
            "gender" => $request->input("gender"),
            "major_id" => $request->input("major_id"),
            "study_program_id" => $request->input("study_program_id")
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

    public function memberDeleteAction(Request $request)
    {
        $member = Member::findOrFail($request->query("id"));
        $member->delete();

        return redirect("/admin/member")->with("success","Anggota berhasil dihapus.");
    }

    public function memberPrintCard(Request $request)
    {
        $member = Member::with("major")->with("studyProgram")->findOrFail($request->query("id"));
        $generatedBarcode = DNS1DFacade::getBarcodePNG($member->nim, "C128");

        $data = [
            "member" => $member,
            "generatedBarcode" => $generatedBarcode
        ];

        return view("standalone.print_card_of_member", $data);
    }

    public function dataMemberSearchJSON(Request $request)
    {
        return Member::where("full_name", "LIKE", "%".$request->query("key")."%")->take(5)->get();
    }

    public function dataTableMemberJSON(Request $request)
    {
        return Datatables::of(Member::with("major")->with("studyProgram")->get())->make();
    }
}
