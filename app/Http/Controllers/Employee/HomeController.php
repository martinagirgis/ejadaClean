<?php

namespace App\Http\Controllers\Employee;

use App\models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\models\FacilityTimes;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index()
    {
        $tasks = Task::where('employee_id',Auth::guard('employee')->id())->get();
        $times = FacilityTimes::where('employee_id',Auth::guard('employee')->id())->get();
        return view('employee.home',compact('tasks', 'times'));
    }
}
