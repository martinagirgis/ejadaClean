<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\models\periodicTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriodicTasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tasksDone()
    {
        $tasks = periodicTask::where('support_type','0')->where('support_id',Auth::guard('employee')->id())->whereIn('state',[5,6])->get();
        return view('employee.PeriodicTask.done',compact('tasks'));
    }

    public function tasksDoneSearsh($id)
    {
        $tasks = periodicTask::where('support_type','0')->where('support_id',Auth::guard('employee')->id())->whereIn('state',[5,6])->whereDate('date',$id)->get();
        return view('employee.PeriodicTask.done',compact('tasks','id'));
    }

    public function taskWaiting()
    {
        $tasks = periodicTask::where('support_type','0')->where('support_id',Auth::guard('employee')->id())->whereIn('state',[2,4])->get();
        return view('employee.PeriodicTask.waiting',compact('tasks'));
    }

    public function taskWaitingSearsh($id)
    {
        $tasks = periodicTask::where('support_type','0')->where('support_id',Auth::guard('employee')->id())->whereIn('state',[2,4])->whereDate('date',$id)->get();
        return view('employee.PeriodicTask.waiting',compact('tasks','id'));
    }

    public function taskNow()
    {
        $tasks = periodicTask::where('support_type','0')->where('support_id',Auth::guard('employee')->id())->whereIn('state',[1,3,7,8])->get();
        return view('employee.PeriodicTask.now',compact('tasks'));
    }

    public function taskNowSearsh($id)
    {
        $tasks = periodicTask::where('support_type','0')->where('support_id',Auth::guard('employee')->id())->whereIn('state',[1,3,7,8])->whereDate('date',$id)->get();
        return view('employee.PeriodicTask.now',compact('tasks','id'));
    }

    public function tasksSend($id)
    {
        $task = periodicTask::find($id);
        return view('employee.PeriodicTask.send',compact('task'));
    }

    public function tasksSendStore(Request $request)
    {
        $task = periodicTask::find($request->id);

        $request->validate([
            'file' => 'required',
        ]);
 
       $title = time().'.'.request()->file->getClientOriginalExtension();
  
       $request->file->move(public_path('assets/attach'), $title);

       $task->update([
            'note' => $request->note,
            'attach' => $title,
            'state' => '2'
        ]);
  
        return response()->json(['success'=>'File Uploaded Successfully']);
    }

    public function tasksDelay($id)
    {
        $task = periodicTask::find($id);

       $task->update([
            'state' => '7'
        ]);

        return redirect()->back()->with('success','تم طلب مد الوقت');
    }

    public function periodicTaskShow($id)
    {
        $task = periodicTask::find($id);
        return view('employee.Tasks.show',compact('task'));
    }
}
