<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Loan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->session()->get("id")){
            return redirect("/admin/login");
        }

        $admin = Admin::findOrFail($request->session()->get("id"));
        $loans = Loan::with("admin")->with("member")->with("item")->get();

        $dataToPass = [
            "admin" => $admin,
            "loans" => $loans
        ];
        
        return view("admin.index", $dataToPass);
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
                return redirect("/admin/login")->with("errorLogin", "Login gagal, username atau password salah!"); 
            }
        }else{
            return redirect("/admin/login")->with("errorLogin", "Login gagal, username atau password salah!");
        }
    }

    public function logoutAction(Request $request)
    {
        $request->session()->flush();
        return redirect("/");
    }
}
