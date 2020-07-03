<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Loan;
use Yajra\DataTables\Facades\DataTables;

class LoanController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next){
            if(!$request->session()->get("id")){
                return redirect("/admin/login");
            }

            return $next($request);
        });
    }

    public function loan(Request $request)
    {
        return view("admin.loan");
    }

    public function loanAdd(Request $request)
    {
        return view("admin.loan_add");
    }

    public function loanAddAction(Request $request)
    {
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

    public function dataTableLoan()
    {
        return DataTables::of(Loan::with("item")->with(["member" => function ($member) {
            $member->with("major")->with("studyProgram");
        }])->with("admin")->get())->make();
    }

    public function dataTableLoanActive()
    {
        return DataTables::of(Loan::with("item")->with(["member" => function ($member) {
            $member->with("major")->with("studyProgram");
        }])->with("admin")->whereNull("returned_date")->where("is_lost", "0")->get())->make();
    }

    public function dataTableLoanFinish()
    {
        return DataTables::of(Loan::with("item")->with(["member" => function ($member) {
            $member->with("major")->with("studyProgram");
        }])->with("admin")->whereNotNull("returned_date")->orWhere("is_lost", "1")->get())->make();
    }
}
