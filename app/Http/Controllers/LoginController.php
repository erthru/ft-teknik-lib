<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AdminRepository;

class LoginController extends Controller
{
    private $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function index(Request $request)
    {
        return view("login");
    }

    public function auth(Request $request)
    {
        
    }

    public function logout(Request $request)
    {
        return view("index/landing");
    }
}
