<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AdminRepositories;

class LoginController extends Controller
{
    private $adminRepositories;

    public function __construct(AdminRepositories $adminRepositories)
    {
        $this->adminRepositories = $adminRepositories;
    }

    public function index(Request $request)
    {
        
    }

    public function loginAction(Request $request)
    {
        
    }
}
