<?php

namespace App\Http\Controllers\Supervisor;

use App\models\Task;
use App\models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:supervisor');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::where('supervisor_id', Auth::guard('supervisor')->id())->get();
        return view('supervisor.employees.index', compact('employees'));
    }

    public function allTasks($id)
    {
        $tasks = Task::where('employee_id', $id)->get();
        return view('supervisor.employees.tasks', compact('tasks'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supervisor.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'email' => ['required', 'email', 'max:255', 'unique:employees'],
        ];

        $this->validate($request,$rules);
        Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'real_password' => $request->password,
            'phone' => $request->phone,
            'job_num' => $request->job_num,
            'id_num' => $request->id_num,
            'type' => $request->type,
            'date' => $request->date,
            'supervisor_id' => Auth::guard('supervisor')->id(),
        ]);

        return redirect()->route('supervisorEmployees.index')->with('success', 'تم الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('supervisor.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('supervisor.employees.edit', compact('employee'));
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
        $employee = Employee::find($id);

        $rules = [
            'email' => ['required', 'email', 'max:255', 'unique:employees,email,' . $employee->id ],
        ];

        $this->validate($request,$rules);

        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'real_password' => $request->password,
            'phone' => $request->phone,
            'job_num' => $request->job_num,
            'id_num' => $request->id_num,
            'type' => $request->type,
            'date' => $request->date,
            'supervisor_id' => Auth::guard('supervisor')->id(),
        ]);
        return redirect()->route('supervisorEmployees.index')->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $old = Employee::find($id);
        $old->delete();
        return redirect()->route('supervisorEmployees.index')->with('success', 'تم الحذف بنجاح');
    }

    public function sendTaskNow($id)
    {
        return view('supervisor.Tasks.now');
    }

    public function taskAll($id)
    {
        return view('supervisor.Tasks.all');
    }
}
