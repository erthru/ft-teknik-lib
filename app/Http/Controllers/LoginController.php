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
        
    }

    public function loginAction(Request $request)
    {
        
    }
}
