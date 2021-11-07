<?php

namespace App\Http\Controllers\Supervisor;

use App\models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\periodicTask;
use Illuminate\Support\Facades\Auth;

class PeriodicTasksController extends Controller
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
            array_push( $tasks,  periodicTask::where('support_type', 0)->where('support_id', $employee->id)->with('employee')->get());
        }

        $type = 'all';
        return view('supervisor.PeriodicTasks.all',compact('tasks', 'type'));
    }

    public function allSearsh($id)
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        $tasks = [];
        foreach($employees as $employee)
        {
            array_push( $tasks,  periodicTask::where('support_type', 0)->where('support_id', $employee->id)->with('employee')->whereDate('date',$id)->get());
        }

        $type = 'all';
        return view('supervisor.PeriodicTasks.all',compact('tasks', 'type','id'));
    }

    public function new()
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        $tasks = [];
        foreach($employees as $employee)
        {
            array_push( $tasks, periodicTask::whereIn('state', ['2'])->where('support_type', 0)->where('support_id', $employee->id)->with('employee')->get());
        }

        $type = 'new';
        return view('supervisor.PeriodicTasks.all',compact('tasks', 'type'));
    }

    public function newSearsh($id)
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        $tasks = [];
        foreach($employees as $employee)
        {
            array_push( $tasks, periodicTask::whereIn('state', ['2'])->where('support_type', 0)->where('support_id', $employee->id)->with('employee')->whereDate('date',$id)->get());
        }

        $type = 'new';
        return view('supervisor.PeriodicTasks.all',compact('tasks', 'type', 'id'));
    }

    public function denay()
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        $tasks = [];
        foreach($employees as $employee)
        {
            array_push( $tasks,  periodicTask::where('state', '7')->where('support_type', 0)->where('support_id', $employee->id)->with('employee')->get());
        }

        $type = 'denay';
        return view('supervisor.PeriodicTasks.all',compact('tasks', 'type'));
    }

    public function denaySearsh($id)
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        $tasks = [];
        foreach($employees as $employee)
        {
            array_push( $tasks,  periodicTask::where('state', '7')->where('support_type', 0)->where('support_id', $employee->id)->with('employee')->whereDate('date',$id)->get());
        }

        $type = 'denay';
        return view('supervisor.PeriodicTasks.all',compact('tasks', 'type', 'id'));
    }

    public function waiting()
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        $tasks = [];
        foreach($employees as $employee)
        {
            array_push( $tasks,  periodicTask::where('state', '4')->where('support_type', 0)->where('support_id', $employee->id)->with('employee')->get());
        }

        $type = 'waiting';
        return view('supervisor.PeriodicTasks.all',compact('tasks', 'type'));
    }

    public function waitingSearsh($id)
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        $tasks = [];
        foreach($employees as $employee)
        {
            array_push( $tasks,  periodicTask::where('state', '4')->where('support_type', 0)->where('support_id', $employee->id)->with('employee')->whereDate('date',$id)->get());
        }

        $type = 'waiting';
        return view('supervisor.PeriodicTasks.all',compact('tasks', 'type', 'id'));
    }

    public function waitingEmp()
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        $tasks = [];
        foreach($employees as $employee)
        {
            array_push( $tasks,  periodicTask::whereIn('state', ['1', '8'])->where('support_type', 0)->where('support_id', $employee->id)->with('employee')->get());
        }

        $type = 'waitingEmp';
        return view('supervisor.PeriodicTasks.all',compact('tasks', 'type'));
    }

    public function taskswaitingEmpSearsh($id)
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        $tasks = [];
        foreach($employees as $employee)
        {
            array_push( $tasks,  periodicTask::whereIn('state', ['1', '8'])->where('support_type', 0)->where('support_id', $employee->id)->with('employee')->whereDate('date',$id)->get());
        }

        $type = 'waitingEmp';
        return view('supervisor.PeriodicTasks.all',compact('tasks', 'type', 'id'));
    }

    public function finished()
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        $tasks = [];
        foreach($employees as $employee)
        {
            array_push( $tasks,  periodicTask::where('state', '2')->where('support_type', 0)->where('support_id', $employee->id)->with('employee')->get());
        }

        return view('supervisor.PeriodicTasks.all',compact('tasks'));
    }

    public function show($id)
    {
        $task = periodicTask::find($id);
        return view('supervisor.PeriodicTasks.show',compact('task'));
    }

    public function TaskAccept($id)
    {
        $task = periodicTask::find($id);
        $task->update([
            'state' => '4',
        ]);

        return redirect()->back()->with('success','تم قبول المهمه ');
    }

    public function TaskRefused($id)
    {
        $task = periodicTask::find($id);
        // $task->update([
        //     'state' => '3',
        // ]);

        return view('supervisor.PeriodicTasks.renew', compact('task'))->with('success','زيادة وقت المهمة');
    }

    public function renewTask(Request $request)
    {
        $task = periodicTask::find($request->id);
        $task->update([
            'date' => $request->date,
            'time' => $request->time,
            'period' => $request->period,
            'state' => '3',
        ]);

        return redirect()->route('supervisor.PeriodicTasks.index')->with('success','زيادة وقت المهمة');
    }

    public function TaskDelayAccept($id)
    {
        $task = periodicTask::find($id);
        return view('supervisor.PeriodicTasks.renewDelay', compact('task'))->with('success','زيادة وقت المهمة');
    }

    public function TaskDelayRefused($id)
    {
        $task = periodicTask::find($id);
        $task->update([
            'state' => '9',
        ]);

        return redirect()->back()->with('success','تم رفض المهمه ');
    }

    public function renewDelayTask(Request $request)
    {
        $task = periodicTask::find($request->id);
        $task->update([
            'date' => $request->date,
            'time' => $request->time,
            'period' => $request->period,
            'state' => '8',
        ]);

        return redirect()->route('supervisor.PeriodicTasks.index')->with('success','زيادة وقت المهمة');
    }

}
