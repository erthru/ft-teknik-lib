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
        }])->with("admin")->whereNull("returned_date")->get())->make();
    }

    public function dataTableLoanFinish()
    {
        return DataTables::of(Loan::with("item")->with(["member" => function ($member) {
            $member->with("major")->with("studyProgram");
        }])->with("admin")->whereNotNull("returned_date")->get())->make();
    }
}
