<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Loan;
use App\Item;
use App\Member;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        $admin = Admin::findOrFail($request->session()->get("id"));
        $totalBook = Item::where("type", "BOOK")->count();
        $totalEssay = Item::where("type", "ESSAY")->count();
        $totalMember = Member::count();
        $loanActive = Loan::whereNull("returned_date")->count();

        $thisMonthDate = DB::select("SELECT CURDATE() AS cur")[0]->cur;
        $thisMonthNextDate = DB::select("SELECT DATE(CURDATE() - INTERVAL 1 MONTH) AS cur")[0]->cur;
        $thisMonthNext2Date = DB::select("SELECT DATE(CURDATE() - INTERVAL 2 MONTH) AS cur")[0]->cur;
        $thisMonthNext3Date = DB::select("SELECT DATE(CURDATE() - INTERVAL 3 MONTH) AS cur")[0]->cur;
        $thisMonthNext4Date = DB::select("SELECT DATE(CURDATE() - INTERVAL 4 MONTH) AS cur")[0]->cur;

        $loanCycleThisMonth = Loan::whereRaw("MONTH(borrowed_date) = MONTH('".$thisMonthDate."')")->count();
        $loanCycleNextMonth = Loan::whereRaw("MONTH(borrowed_date) = MONTH('".$thisMonthNextDate."')")->count();
        $loanCycleNext2Month = Loan::whereRaw("MONTH(borrowed_date) = MONTH('".$thisMonthNext2Date."')")->count();
        $loanCycleNext3Month = Loan::whereRaw("MONTH(borrowed_date) = MONTH('".$thisMonthNext3Date."')")->count();
        $loanCycleNext4Month = Loan::whereRaw("MONTH(borrowed_date) = MONTH('".$thisMonthNext4Date."')")->count();

        $loanByMen = 0;
        Loan::with(["member" => function($member) use(&$loanByMen) {
            $member->where("gender", "MEN");
            $loanByMen = $member->count();
        }])->get();

        $loanByWomen = 0;
        Loan::with(["member" => function($member) use(&$loanByWomen) {
            $member->where("gender", "WOMEN");
            $loanByWomen = $member->count();
        }])->get();

        $lastTenLoans = Loan::with("member")->with("item")->orderBy("id", "DESC")->take(10)->get();

        $data = [
            "admin" => $admin,
            "totalBook" => $totalBook,
            "totalEssay" => $totalEssay,
            "totalMember" => $totalMember,
            "loanActive" => $loanActive,
            "thisMonthDate" => date("m/Y", strtotime($thisMonthDate)),
            "thisMonthNextDate" => date("m/Y", strtotime($thisMonthNextDate)),
            "thisMonthNext2Date" => date("m/Y", strtotime($thisMonthNext2Date)),
            "thisMonthNext3Date" => date("m/Y", strtotime($thisMonthNext3Date)),
            "thisMonthNext4Date" => date("m/Y", strtotime($thisMonthNext4Date)),
            "loanCycleThisMonth" => $loanCycleThisMonth,
            "loanCycleNextMonth" => $loanCycleNextMonth,
            "loanCycleNext2Month" => $loanCycleNext2Month,
            "loanCycleNext3Month" => $loanCycleNext3Month,
            "loanCycleNext4Month" => $loanCycleNext4Month,
            "loanByMen" => $loanByMen,
            "loanByWomen" => $loanByWomen,
            "lastTenLoans" => $lastTenLoans,
        ];
        
        return view("admin.admin", $data);
    }

    public function login(Request $request)
    {
        if($request->session()->get("id")){
            return redirect("/admin");
        }

        return view("standalone.login");
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ])->validate();

        $admin = Admin::where("username", $request->input("username"))->first();
        
        if($admin){
            if(Hash::check($request->input("password"), $admin->password)){
                $request->session()->put("id", $admin->id);
                return redirect("/admin");
            }else{
                return redirect("/admin/login")->with("error", "Login gagal, username atau password salah!"); 
            }
        }else{
            return redirect("/admin/login")->with("error", "Login gagal, username atau password salah!");
        }
    }

    public function logoutAction(Request $request)
    {
        $request->session()->flush();
        return redirect("/");
    }
}
