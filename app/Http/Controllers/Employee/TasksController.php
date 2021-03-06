<?php

namespace App\Http\Controllers\Employee;

use App\models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
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
        $tasks = Task::where('support_type','0')->where('support_id',Auth::guard('employee')->id())->whereIn('state',[5,6])->get();
        return view('employee.Tasks.done',compact('tasks'));
    }

    public function tasksDoneSearsh($id)
    {
        $tasks = Task::where('support_type','0')->where('support_id',Auth::guard('employee')->id())->whereIn('state',[5,6])->whereDate('date',$id)->get();
        return view('employee.Tasks.done',compact('tasks','id'));
    }

    public function taskWaiting()
    {
        $tasks = Task::where('support_type','0')->where('support_id',Auth::guard('employee')->id())->whereIn('state',[2,4])->get();
        return view('employee.Tasks.waiting',compact('tasks'));
    }

    public function taskWaitingSearsh($id)
    {
        $tasks = Task::where('support_type','0')->where('support_id',Auth::guard('employee')->id())->whereIn('state',[2,4])->whereDate('date',$id)->get();
        return view('employee.Tasks.waiting',compact('tasks','id'));
    }

    public function taskNow()
    {
        $tasks = Task::where('support_type','0')->where('support_id',Auth::guard('employee')->id())->whereIn('state',[1,3,7,8])->get();
        return view('employee.Tasks.now',compact('tasks'));
    }

    public function taskNowSearsh($id)
    {
        $tasks = Task::where('support_type','0')->where('support_id',Auth::guard('employee')->id())->whereIn('state',[1,3,7,8])->whereDate('date',$id)->get();
        return view('employee.Tasks.now',compact('tasks','id'));
    }

    public function tasksSend($id)
    {
        $task = Task::find($id);
        return view('employee.Tasks.send',compact('task'));
    }

    public function tasksSendStore(Request $request)
    {
        $task = Task::find($request->id);

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
        $task = Task::find($id);

       $task->update([
            'state' => '7'
        ]);

        return redirect()->back()->with('success','???? ?????? ???? ??????????');
    }

    public function taskShow($id)
    {
        $task = Task::find($id);
        return view('employee.Tasks.show',compact('task'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sendTaskNow($id)
    {
        return view('employee.Tasks.now');
    }
}
