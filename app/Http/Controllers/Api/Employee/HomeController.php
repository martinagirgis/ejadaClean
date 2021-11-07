<?php

namespace App\Http\Controllers\Api\Employee;

use App\models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\models\FacilityTimes;
use App\models\periodicTask;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index()
    {
        $tasks = Task::where('support_type','0')->where('support_id',Auth::guard('employee')->id())->get();
        $periodicTasks = periodicTask::where('support_type','0')->where('support_id',Auth::guard('employee')->id())->get();
        return view('employee.home2',compact('tasks', 'periodicTasks'));
    }
}
