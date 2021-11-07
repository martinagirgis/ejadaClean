<?php

namespace App\Http\Controllers\CleanMaintananceManager;

use App\models\Task;
use App\models\Team;
use App\models\Complaint;
use App\models\Supervisor;
use App\models\periodicTask;
use Illuminate\Http\Request;
use App\models\SponsorintCompany;
use App\Http\Controllers\Controller;
use App\models\Facility;
use App\models\FacilityTimes;
use Illuminate\Support\Facades\Auth;

class PeriodicTasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:clean_mantanance_manager');
    }

    public function confirmPeriodicTask($id)
    {
        $facilities = Facility::where('branch_id', Auth::guard('clean_mantanance_manager')->user()->branch->id)->get();
        $tasks = [];
        $date = date('Y-m-d', strtotime($id));
        $day = date('D', strtotime($date));
        foreach($facilities as $facility)
        {
           array_push( $tasks,  FacilityTimes::where('facility_id', $facility->id)->where('day',$day)->get());
        }
        $id = $date;
        return view('cleanMaintananceManager.periodicTasks.conferm',compact('tasks','id'));
    }

    public function addPeriodicTask(Request $request)
    {
        $facilities = Facility::where('branch_id', Auth::guard('clean_mantanance_manager')->user()->branch->id)->get();
        $tasks = [];
        $date = date('Y-m-d', strtotime($request->datee));
        $day = date('D', strtotime($date));
        foreach($facilities as $facility)
        {
           $tasks =  FacilityTimes::where('facility_id', $facility->id)->where('day',$day)->get();
           for ($i=0; $i < count($tasks); $i++) { 
                periodicTask::create([
                    'title' => $tasks[$i]->title,
                    'description' => $tasks[$i]->description,
                    'type' => $tasks[$i]->type,
                    'date' => $date,
                    'time' => $tasks[$i]->time,
                    'period' => $tasks[$i]->period,
                    'support_type' => '0',
                    'support_id' => $tasks[$i]->employee_id,
                    'facility_id' => $facility->id,
                    'branch_id' => Auth::guard('clean_mantanance_manager')->user()->branch->id,
                    'state' => '1',
                ]);
           }
        }
        $id = $date;
        return redirect()->route('managerClean.PeriodicTasks.All')->with('success', 'تم اضافة المهمات');
    }

    public function taskNow()
    {
        $typee = 'now';
        $tasks = periodicTask::where('branch_id', Auth::guard('clean_mantanance_manager')->user()->branch->id)->where('state','4')->get();
        return view('cleanMaintananceManager.periodicTasks.all', compact('tasks','typee'));
    }

    public function tasksAll()
    {
        $typee = 'index';
        $tasks = periodicTask::where('branch_id', Auth::guard('clean_mantanance_manager')->user()->branch->id)->get();
        return view('cleanMaintananceManager.periodicTasks.all', compact('tasks','typee'));
    }

    public function nowSearsh($id)
    {
        $typee = 'now';
        $tasks = periodicTask::where('branch_id', Auth::guard('clean_mantanance_manager')->user()->branch->id)->where('state','4')->whereDate('created_at',$id)->get();
        return view('cleanMaintananceManager.periodicTasks.all', compact('tasks','id','typee'));
    }

    public function indexSerch($id)
    {
        $typee = 'index';
        $tasks = periodicTask::where('branch_id', Auth::guard('clean_mantanance_manager')->user()->branch->id)->whereDate('created_at',$id)->get();
        return view('cleanMaintananceManager.periodicTasks.all', compact('tasks','id','typee'));
    }

    public function show($id)
    {
        $task = periodicTask::find($id);
        return view('cleanMaintananceManager.periodicTasks.show', compact('task'));
    }

    // public function createTaskComplaint($id)
    // {
    //     $complaint = Complaint::find($id);
    //     return view('cleanMaintananceManager.periodicTasks.createTaskComplaint', compact('complaint'));
    // }

    public function createTask()
    {
        return view('cleanMaintananceManager.periodicTasks.createTask');
    }

    public function renewTask($id)
    {
        $task = periodicTask::find($id);
        return view('cleanMaintananceManager.periodicTasks.renewcereate', compact('task'));
    }

    public function getTypeMempers(Request $request)
    {
        if($request->type == '0')
        {
            $supervisors = Supervisor::where('clean_mantanance_manager_id', Auth::guard('clean_mantanance_manager')->id())
            ->with('employee')
            ->get();
            return response()->json($supervisors);
        }
        elseif($request->type == '1')
        {
            $teams = Team::where('clean_mantanance_manager_id', Auth::guard('clean_mantanance_manager')->id())->get();
            return response()->json($teams);
        }
        elseif($request->type == '2')
        {
            $companies = SponsorintCompany::where('clean_mantanance_manager_id', Auth::guard('clean_mantanance_manager')->id())->get();
            return response()->json($companies);
        }
    }


    public function editTask($id)
    {
        $task = periodicTask::find($id);
        return view('cleanMaintananceManager.periodicTasks.edit', compact('task'));
    }

    public function updateTask(Request $request, $id)
    {
        $task = periodicTask::find($id);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'date' => $request->date,
            'time' => $request->time,
            'period' => $request->period,
            'support_type' => $request->support_type,
            'support_id' => $request->support_id,
        ]);

        return redirect()->route('managerClean.PeriodicTasks.All')->with('success','تم تعديل المهمه ');
    }

    public function DeleteTask($id)
    {
        $old = periodicTask::find($id);
        $old->delete();
        return redirect()->back()->with('success','تم حذف المهمه ');
    }

    public function TaskAccept($id)
    {
        $task = periodicTask::find($id);
        $task->update([
            'state' => '5',
        ]);

        return redirect()->back()->with('success','تم قبول المهمه ');
    }

    public function TaskRefused($id)
    {
        $task = periodicTask::find($id);
        $task->update([
            'state' => '6',
        ]);

        return redirect()->route('managerClean.periodicTasks.renew',['id' => $id])->with('success','تم رفض المهمة');
    }
}
