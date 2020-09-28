<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Loan;
use App\Item;
use App\Member;
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

        $dueDate = strtotime($loan->due_date);
        $returnedDate = strtotime($request->query("returned_date"));
        $fine = 0;

        if($returnedDate > $dueDate) {
            $diff = $returnedDate - $dueDate;
            $diffInDays = (int) round($diff / (60 * 60 * 24));

            $fine = $diffInDays * 1000;
        }

        $body = [
            "returned_date" => $request->query("returned_date"),
            "fine" => $fine
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

    public function loanSetPaidAction(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        $loan = Loan::findOrFail($request->query("id"));

        $body = [
            "is_paid" => "1"
        ];

        $loan->update($body);

        return redirect("/admin/loan")->with("success", "Peminjaman diset ke telah dibayar/diganti!");
    }

    public function loanReport(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        $fromDate = $request->query("from")." 00:00:00";
        $toDate = $request->query("to")." 23:59:59";

        $data = [
            "registeredBooks" => null,
            "registeredEssay" => null,
            "registeredLoans" => null
        ];

        if(!empty($fromDate) && !empty($toDate)){
            $registeredBooks = Item::whereRaw("created_at BETWEEN '".$fromDate."' AND '".$toDate."' AND type='BOOK'")->orderBy("id", "DESC")->get();
            
            $registeredEssay = Item::whereRaw("created_at BETWEEN '".$fromDate."' AND '".$toDate."' AND type='ESSAY'")->orderBy("id", "DESC")->get();
            
            $registeredLoans = Loan::with("item")->with(["member" => function ($member) {
                $member->with("major")->with("studyProgram");
            }])->with("admin")->whereRaw("created_at BETWEEN '".$fromDate."' AND '".$toDate."'")->orderBy("returned_date", "ASC")->orderBy("is_lost", "ASC")->get();

            $registeredLoansActiveCount = Loan::whereRaw("returned_date IS NULL AND is_lost = '0' AND created_at BETWEEN '".$fromDate."' AND '".$toDate."'")->count();
            
            $registeredLoansLostCount = Loan::whereRaw("is_lost = '1' AND created_at BETWEEN '".$fromDate."' AND '".$toDate."'")->count();

            $data = [
                "registeredBooks" => $registeredBooks,
                "registeredEssays" => $registeredEssay,
                "registeredLoans" => $registeredLoans,
                "registeredLoansActiveCount" => $registeredLoansActiveCount,
                "registeredLoansLostCount" => $registeredLoansLostCount
            ];
        }

        return view("admin.report", $data);
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
