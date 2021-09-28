<?php

namespace App\Http\Controllers\CleanMaintananceManager;

use App\models\Task;
use App\models\Employee;
use App\models\Supervisor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:clean_mantanance_manager');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supervisors = Supervisor::where('clean_mantanance_manager_id', Auth::guard('clean_mantanance_manager')->id())->get();
        return view('cleanMaintananceManager.employees.index', compact('supervisors'));
    }

    public function allTasks($id)
    {
        $tasks = Task::where('employee_id', $id)->get();
        return view('cleanMaintananceManager.employees.tasks', compact('tasks'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supervisors = Supervisor::where('clean_mantanance_manager_id', Auth::guard('clean_mantanance_manager')->id())->get();
        return view('cleanMaintananceManager.employees.create', compact('supervisors'));
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
            'supervisor_id' => $request->supervisor_id,
        ]);

        return redirect()->route('employees.index')->with('success', 'تم الاضافة بنجاح');
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
        return view('cleanMaintananceManager.employees.show', compact('employee'));
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
        $supervisors = Supervisor::where('clean_mantanance_manager_id', Auth::guard('clean_mantanance_manager')->id())->get();
        return view('cleanMaintananceManager.employees.edit', compact('employee', 'supervisors'));
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
            'supervisor_id' => $request->supervisor_id,
        ]);
        return redirect()->route('employees.index')->with('success', 'تم التعديل بنجاح');
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
        return redirect()->route('employees.index')->with('success', 'تم الحذف بنجاح');
    }
}
