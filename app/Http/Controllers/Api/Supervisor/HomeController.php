<?php

namespace App\Http\Controllers\Supervisor;

use App\models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:supervisor');
    }

    public function index()
    {
        $employeeNum = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->count();
        return view('supervisor.home', compact('employeeNum'));
    }
}
