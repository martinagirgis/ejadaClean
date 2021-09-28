<?php

namespace App\Http\Controllers\GeneralManager;

use App\models\Branch;
use App\models\Employee;
use App\models\Supervisor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\models\CleanMantananceManager;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:company_general_manager');
    }
    
    public function index()
    {
        $branchNum = Branch::where('company_id', Auth::guard('company_general_manager')->id())->count();
        $branch = Branch::where('company_id', Auth::guard('company_general_manager')->id())->get();
        $managerNum = 0;
        $supervisorNum = 0 ;
        $employeeNum = 0;
        for ($i=0; $i < $branchNum; $i++) { 
            $managerNum += count($branch[$i]->cleanManager);

            for ($y=0; $y < count($branch[$i]->cleanManager); $y++) {
                $supervisorNum += count($branch[$i]->cleanManager[$y]->supervisor);

                for ($z=0; $z < count($branch[$i]->cleanManager[$y]->supervisor); $z++) {
                    $employeeNum += count($branch[$i]->cleanManager[$y]->supervisor[$z]->employee);
                } 
            }
        }
        return view('generalManager.home',compact('branchNum', 'employeeNum', 'supervisorNum', 'managerNum'));
    }
}
