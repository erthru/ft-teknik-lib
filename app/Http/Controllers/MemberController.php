<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Major;
use App\StudyProgram;
use App\Loan;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Milon\Barcode\Facades\DNS1DFacade;

class MemberController extends Controller
{
    public function member(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        return view("admin.member");
    }

    public function memberAdd(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        $majors = Major::get();

        $data = [
            "majors" => $majors,
        ];

        return view("admin.member_add", $data);
    }

    public function memberAddAction(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

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
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

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
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

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
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        $member = Member::findOrFail($request->query("id"));
        $member->delete();

        return redirect("/admin/member")->with("success","Anggota berhasil dihapus.");
    }

    public function memberPrintCard(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        $member = Member::with("major")->with("studyProgram")->findOrFail($request->query("id"));
        $generatedBarcode = DNS1DFacade::getBarcodePNG($member->nim, "C128");

        $data = [
            "member" => $member,
            "generatedBarcode" => $generatedBarcode
        ];

        return view("admin.member_card", $data);
    }

    public function memberCBP(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        $member = Member::with("major")->with("studyProgram")->findOrFail($request->query("id"));
        $loansIsNotPaid = Loan::where(function($query){
            $query->where("is_lost", "1")->orWhere("fine", ">", 0)->orWhereNull("returned_date");
        })->where("is_paid", "0")->where("member_id", $member->id)->get();

        $data = [
            "member" => $member,
            "loanIsNotPaid" => $loansIsNotPaid
        ];

        return view("admin.member_cbp", $data);
    }

    public function dataMemberSearchJSON(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        return Member::where("full_name", "LIKE", "%".$request->query("key")."%")->orWhere("nim", "".$request->query("key")."")->take(5)->get();
    }

    public function dataTableMemberJSON(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }
        
        return Datatables::of(Member::with("major")->with("studyProgram")->get())->make();
    }
}
