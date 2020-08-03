<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Loan;
use Yajra\DataTables\Facades\DataTables;

class LoanController extends Controller
{
    public function loan(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        return view("admin.loan");
    }

    public function loanAdd(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        return view("admin.loan_add");
    }

    public function loanAddAction(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        Validator::make($request->all(), [
            'borrowed_date' => 'required',
            'item_id' => 'required',
            'member_id' => 'required'
        ])->validate();

        $dueDate = date("Y-m-d", strtotime($request->input("borrowed_date"). " + 7 days"));
        
        $body = [
            "borrowed_date" => $request->input("borrowed_date"),
            "due_date" => $dueDate,
            "is_lost" => "0",
            "item_id" => $request->input("item_id"),
            "member_id" => $request->input("member_id"),
            "admin_id" => $request->session()->get("id")
        ];

        Loan::create($body);

        return redirect("/admin/loan")->with("success","Peminjaman baru ditambahkan.");
    }

    public function loanDetail(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        $loan = Loan::with("admin")
        ->with(["member" => function ($member){
            $member->with("major")->with("studyProgram");
        }])
        ->with("item")
        ->findOrFail($request->query("id"));

        $data = [
            "loan" => $loan
        ];

        return view("admin.loan_detail", $data);
    }

    public function loanSetReturnedAction(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        Validator::make($request->all(), [
            'returned_date' => 'required',
        ])->validate();

        $loan = Loan::findOrFail($request->query("id"));

        $body = [
            "returned_date" => $request->query("returned_date")
        ];

        $loan->update($body);

        return redirect("/admin/loan")->with("success", "Peminjaman dikembalikan!");
    }

    public function loanSetLostAction(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        $loan = Loan::findOrFail($request->query("id"));

        $body = [
            "is_lost" => "1"
        ];

        $loan->update($body);

        return redirect("/admin/loan")->with("success", "Peminjaman diset ke hilang!");
    }

    public function report(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        return view("admin.report");
    }

    public function dataTableLoanJSON(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        return DataTables::of(Loan::with("item")->with(["member" => function ($member) {
            $member->with("major")->with("studyProgram");
        }])->with("admin")->get())->make();
    }

    public function dataTableLoanActiveJSON(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        return DataTables::of(Loan::with("item")->with(["member" => function ($member) {
            $member->with("major")->with("studyProgram");
        }])->with("admin")->whereNull("returned_date")->where("is_lost", "0")->get())->make();
    }

    public function dataTableLoanFinishJSON(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }
        
        return DataTables::of(Loan::with("item")->with(["member" => function ($member) {
            $member->with("major")->with("studyProgram");
        }])->with("admin")->whereNotNull("returned_date")->orWhere("is_lost", "1")->get())->make();
    }
}
