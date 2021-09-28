<?php

namespace App\Http\Controllers\CleanMaintananceManager;

use App\models\Employee;
use App\models\Facility;
use App\models\Supervisor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\SponsorintCompany;
use App\models\Team;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:clean_mantanance_manager');
    }
    
    public function index()
    {
        $supervisorNum = Supervisor::where('clean_mantanance_manager_id', Auth::guard('clean_mantanance_manager')->id())->count();
        $supervisor = Supervisor::where('clean_mantanance_manager_id', Auth::guard('clean_mantanance_manager')->id())->get();
        $employeeMaintanaceNum = 0;
        $employeeCleanNum = 0;
        for ($i=0; $i < $supervisorNum; $i++) { 
            for ($y=0; $y < count($supervisor[$i]->employee); $y++) { 
                if ($supervisor[$i]->employee[$y]->type == '0') {
                    $employeeMaintanaceNum += 1;
                }
                elseif($supervisor[$i]->employee[$y]->type == '1') {
                    $employeeCleanNum += 1;
                }
            }
        }
        $facilityNum = Facility::where('branch_id', Auth::guard('clean_mantanance_manager')->user()->branch->id)->count();
        $teamNum = Team::where('clean_mantanance_manager_id', Auth::guard('clean_mantanance_manager')->id())->count();
        $sponsorintCompanyNum = SponsorintCompany::where('clean_mantanance_manager_id', Auth::guard('clean_mantanance_manager')->id())->count();

        return view('cleanMaintananceManager.home',compact('employeeMaintanaceNum', 'employeeCleanNum', 'facilityNum', 'sponsorintCompanyNum', 'teamNum', 'supervisorNum'));
    }
}
