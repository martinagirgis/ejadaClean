<?php

namespace App\Http\Controllers\Supervisor;

use App\models\Task;
use App\models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:supervisor');
    }

    public function index()
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        $tasks = [];
        foreach($employees as $employee)
        {
            array_push( $tasks, Task::where('support_type', 0)->where('support_id', $employee->id)->with('employee')->get());
        }

        $type = 'all';
        return view('supervisor.Tasks.all',compact('tasks','type'));
    }

    public function tasksallSearsh($id)
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        $tasks = [];
        foreach($employees as $employee)
        {
            array_push( $tasks, Task::where('support_type', 0)->where('support_id', $employee->id)->with('employee')->whereDate('date',$id)->get());
        }

        $type = 'all';
        return view('supervisor.Tasks.all',compact('tasks','type','id'));
    }

    public function new()
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        $tasks = [];
        foreach($employees as $employee)
        {
            array_push( $tasks, Task::whereIn('state', ['2'])->where('support_type', 0)->where('support_id', $employee->id)->with('employee')->get());
        }
        $type = 'new';
        return view('supervisor.Tasks.all',compact('tasks','type'));
    }

    public function newSearsh($id)
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        $tasks = [];
        foreach($employees as $employee)
        {
            array_push( $tasks, Task::whereIn('state', ['2'])->where('support_type', 0)->where('support_id', $employee->id)->whereDate('date',$id)->get());
        }
        $type = 'new';
        return view('supervisor.Tasks.all',compact('tasks','type','id'));
    }

    public function denay()
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        $tasks = [];
        foreach($employees as $employee)
        {
            array_push( $tasks, Task::where('state', '7')->where('support_type', 0)->where('support_id', $employee->id)->with('employee')->get());
        }

        $type = 'denay';
        return view('supervisor.Tasks.all',compact('tasks','type'));
    }

    public function denaySearsh($id)
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        $tasks = [];
        foreach($employees as $employee)
        {
            array_push( $tasks, Task::where('state', '7')->where('support_type', 0)->where('support_id', $employee->id)->with('employee')->whereDate('date',$id)->get());
        }

        $type = 'denay';
        return view('supervisor.Tasks.all',compact('tasks','type','id'));
    }

    public function waiting()
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        $tasks = [];
        foreach($employees as $employee)
        {
            array_push( $tasks, Task::where('state', '4')->where('support_type', 0)->where('support_id', $employee->id)->with('employee')->get());
        }

        $type = 'waiting';
        return view('supervisor.Tasks.all',compact('tasks','type'));
    }

    public function waitingSearsh($id)
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        $tasks = [];
        foreach($employees as $employee)
        {
            array_push( $tasks, Task::where('state', '4')->where('support_type', 0)->where('support_id', $employee->id)->with('employee')->whereDate('date',$id)->get());
        }

        $type = 'waiting';
        return view('supervisor.Tasks.all',compact('tasks','type','id'));
    }

    public function waitingEmp()
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        $tasks = [];
        foreach($employees as $employee)
        {
            array_push( $tasks, Task::whereIn('state', ['1', '8'])->where('support_type', 0)->where('support_id', $employee->id)->with('employee')->get());
        }

        $type = 'waitingEmp';
        return view('supervisor.Tasks.all',compact('tasks','type'));
    }

    public function taskswaitingEmpSearsh($id)
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        $tasks = [];
        foreach($employees as $employee)
        {
            array_push( $tasks, Task::whereIn('state', ['1', '8'])->where('support_type', 0)->where('support_id', $employee->id)->with('employee')->whereDate('date',$id)->get());
        }

        $type = 'waitingEmp';
        return view('supervisor.Tasks.all',compact('tasks','type','id'));
    }

    public function finished()
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        $tasks = [];
        foreach($employees as $employee)
        {
            array_push( $tasks, Task::where('state', '2')->where('support_type', 0)->where('support_id', $employee->id)->with('employee')->get());
        }

        return view('supervisor.Tasks.all',compact('tasks'));
    }

    public function show($id)
    {
        $task = Task::find($id);
        return view('supervisor.Tasks.show',compact('task'));
    }

    public function TaskAccept($id)
    {
        $task = Task::find($id);
        $task->update([
            'state' => '4',
        ]);

        return redirect()->back()->with('success','تم قبول المهمه ');
    }

    public function TaskRefused($id)
    {
        $task = Task::find($id);
        // $task->update([
        //     'state' => '3',
        // ]);

        return view('supervisor.Tasks.renew', compact('task'))->with('success','زيادة وقت المهمة');
    }

    public function renewTask(Request $request)
    {
        $task = Task::find($request->id);
        $task->update([
            'date' => $request->date,
            'time' => $request->time,
            'period' => $request->period,
            'state' => '3',
        ]);

        return redirect()->route('supervisor.task.index')->with('success','زيادة وقت المهمة');
    }

    public function TaskDelayAccept($id)
    {
        $task = Task::find($id);
        return view('supervisor.Tasks.renewDelay', compact('task'))->with('success','زيادة وقت المهمة');
    }

    public function TaskDelayRefused($id)
    {
        $task = Task::find($id);
        $task->update([
            'state' => '9',
        ]);

        return redirect()->back()->with('success','تم رفض المهمه ');
    }

    public function renewDelayTask(Request $request)
    {
        $task = Task::find($request->id);
        $task->update([
            'date' => $request->date,
            'time' => $request->time,
            'period' => $request->period,
            'state' => '8',
        ]);

        return redirect()->route('supervisor.task.index')->with('success','زيادة وقت المهمة');
    }

    public function taskNowTeam()
    {
        $tasks = Task::where('branch_id', Auth::guard('supervisor')->user()->cleanManager->branch->id)->where('support_type', 1)->where('state', '1')->get();
        return view('supervisor.TasksTeams.now',compact('tasks'));
    }

    public function taskSendTeam($id)
    {
        $task = Task::find($id);
        return view('supervisor.TasksTeams.send',compact('task'));
    }

    public function taskStoreTeam(Request $request)
    {
        //2=> المشرف بعت المهمة للمديربتاعة الفريق
        $task = Task::find($request->id);

        $request->validate([
            'file' => 'required',
        ]);
 
       $title = time().'.'.request()->file->getClientOriginalExtension();
  
       $request->file->move(public_path('assets/attach'), $title);

       $task->update([
            'note' => $request->note,
            'attach' => $title,
            'state' => '4'
        ]);
  
        return response()->json(['success'=>'File Uploaded Successfully']);
    }

    public function taskDoneTeam()
    {
        $tasks = Task::where('branch_id', Auth::guard('supervisor')->user()->cleanManager->branch->id)->where('support_type', 1)->whereIn('state', ['5','6'])->get();
        return view('supervisor.TasksTeams.done',compact('tasks'));
    }

    public function taskWaitingTeam()
    {
        $tasks = Task::where('branch_id', Auth::guard('supervisor')->user()->cleanManager->branch->id)->where('support_type', 1)->where('state', '4')->get();
        return view('supervisor.TasksTeams.waiting',compact('tasks'));
    }

    public function taskNowCompany()
    {
        $tasks = Task::where('branch_id', Auth::guard('supervisor')->user()->cleanManager->branch->id)->where('support_type', 2)->where('state', '1')->get();
        return view('supervisor.TasksCompanies.now',compact('tasks'));
    }

    
    public function taskSendCompany($id)
    {
        $task = Task::find($id);
        return view('supervisor.TasksCompanies.send',compact('task'));
    }

    public function taskStoreCompany(Request $request)
    {
        //2=> المشرف بعت المهمة للمديربتاعة الفريق
        $task = Task::find($request->id);

        $request->validate([
            'file' => 'required',
        ]);
 
       $title = time().'.'.request()->file->getClientOriginalExtension();
  
       $request->file->move(public_path('assets/attach'), $title);

       $task->update([
            'note' => $request->note,
            'attach' => $title,
            'state' => '4'
        ]);
  
        return response()->json(['success'=>'File Uploaded Successfully']);
    }

    public function taskDoneCompany()
    {
        $tasks = Task::where('branch_id', Auth::guard('supervisor')->user()->cleanManager->branch->id)->where('support_type', 2)->whereIn('state', ['5','6'])->get();
        return view('supervisor.TasksCompanies.done',compact('tasks'));
    }

    public function taskWaitingCompany()
    {
        $tasks = Task::where('branch_id', Auth::guard('supervisor')->user()->cleanManager->branch->id)->where('support_type', 2)->where('state', '4')->get();
        return view('supervisor.TasksCompanies.waiting',compact('tasks'));
    }

    public function teamnowSearsh($id)
    {
        $tasks = Task::where('branch_id', Auth::guard('supervisor')->user()->cleanManager->branch->id)->where('support_type', 1)->where('state', '1')->whereDate('date',$id)->get();
        return view('supervisor.TasksTeams.now',compact('tasks', 'id'));
    }

    public function teamDoneSearsh($id)
    {
        $tasks = Task::where('branch_id', Auth::guard('supervisor')->user()->cleanManager->branch->id)->where('support_type', 1)->whereIn('state', ['5','6'])->whereDate('date',$id)->get();
        return view('supervisor.TasksTeams.done',compact('tasks', 'id'));
    }

    public function teamwaitingSearsh($id)
    {
        $tasks = Task::where('branch_id', Auth::guard('supervisor')->user()->cleanManager->branch->id)->where('support_type', 1)->where('state', '4')->whereDate('date',$id)->get();
        return view('supervisor.TasksTeams.waiting',compact('tasks', 'id'));
    }

    public function companynowSearsh($id)
    {
        $tasks = Task::where('branch_id', Auth::guard('supervisor')->user()->cleanManager->branch->id)->where('support_type', 2)->where('state', '1')->whereDate('date',$id)->get();
        return view('supervisor.TasksCompanies.now',compact('tasks', 'id'));
    }

    public function companyDoneSearsh($id)
    {
        $tasks = Task::where('branch_id', Auth::guard('supervisor')->user()->cleanManager->branch->id)->where('support_type', 1)->whereIn('state', ['5','6'])->whereDate('date',$id)->get();
        return view('supervisor.TasksTeams.done',compact('tasks', 'id'));
    }

    public function companySearsh($id)
    {
        $tasks = Task::where('branch_id', Auth::guard('supervisor')->user()->cleanManager->branch->id)->where('support_type', 1)->where('state', '4')->whereDate('date',$id)->get();
        return view('supervisor.TasksTeams.waiting',compact('tasks', 'id'));
    }

}
