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

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:clean_mantanance_manager');
    }

    public function taskNow()
    {
        $typee = 'now';
        $tasks = Task::where('branch_id', Auth::guard('clean_mantanance_manager')->user()->branch->id)->where('state','4')->get();
        return view('cleanMaintananceManager.tasks.all', compact('tasks','typee'));
    }

    public function tasksAll()
    {
        $typee = 'index';
        $tasks = Task::where('branch_id', Auth::guard('clean_mantanance_manager')->user()->branch->id)->get();
        return view('cleanMaintananceManager.tasks.all', compact('tasks','typee'));
    }

    public function nowSearsh($id)
    {
        $typee = 'now';
        $tasks = Task::where('branch_id', Auth::guard('clean_mantanance_manager')->user()->branch->id)->where('state','4')->whereDate('created_at',$id)->get();
        return view('cleanMaintananceManager.tasks.all', compact('tasks','id','typee'));
    }

    public function indexSerch($id)
    {
        $typee = 'index';
        $tasks = Task::where('branch_id', Auth::guard('clean_mantanance_manager')->user()->branch->id)->whereDate('created_at',$id)->get();
        return view('cleanMaintananceManager.tasks.all', compact('tasks','id','typee'));
    }

    public function show($id)
    {
        $task = Task::find($id);
        return view('cleanMaintananceManager.tasks.show', compact('task'));
    }

    public function createTaskComplaint($id)
    {
        $complaint = Complaint::find($id);
        return view('cleanMaintananceManager.tasks.createTaskComplaint', compact('complaint'));
    }

    public function createTask()
    {
        return view('cleanMaintananceManager.tasks.createTask');
    }

    public function renewTask($id)
    {
        $task = Task::find($id);
        return view('cleanMaintananceManager.tasks.renewcereate', compact('task'));
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

    public function StoreTask(Request $request)
    {
        // support type
        // 0-> العمال
        // 1-> فريق خاص
        // 2-> شركة راعية

        //task
        // 1-> المدير بعتها للعامل
        // 2-> العامل بعتها للمشرف
        // 3-> المشرف رفضها و رجعها للعميل
        // 4-> المشرف قبلها و بعتها للمدير
        // 5-> المدير وافق عليها 
        // 6-> المدير رفضها
        // 7-> طلب مد وقت
        // 8-> المشرف وافق و في انتظار العامل
        // 9-> المشرف رفض

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'date' => $request->date,
            'time' => $request->time,
            'period' => $request->period,
            'support_type' => $request->support_type,
            'support_id' => $request->support_id,
            'branch_id' => Auth::guard('clean_mantanance_manager')->user()->branch->id,
            'state' => '1',
           ]);

        return redirect()->back()->with('success','تم اضافة المهمه ');
    }

    public function editTask($id)
    {
        $task = Task::find($id);
        return view('cleanMaintananceManager.tasks.edit', compact('task'));
    }

    public function updateTask(Request $request, $id)
    {
        $task = Task::find($id);

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

        return redirect()->route('managerClean.tasksAll')->with('success','تم تعديل المهمه ');
    }

    public function DeleteTask($id)
    {
        $old = Task::find($id);
        $old->delete();
        return redirect()->back()->with('success','تم حذف المهمه ');
    }

    public function TaskAccept($id)
    {
        $task = Task::find($id);
        $task->update([
            'state' => '5',
        ]);

        return redirect()->back()->with('success','تم قبول المهمه ');
    }

    public function TaskRefused($id)
    {
        $task = Task::find($id);
        $task->update([
            'state' => '6',
        ]);

        return redirect()->route('managerClean.Task.renew',['id' => $id])->with('success','تم رفض المهمة');
    }

    
}
