<?php

namespace App\Http\Controllers\GeneralManager;

use App\models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Employee;
use App\models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:company_general_manager');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::where('company_id', Auth::guard('company_general_manager')->id())->get();
        return view('generalManager.employees.index', compact('branches'));
    }

    public function allTasks($id)
    {
        $tasks = Task::where('employee_id', $id)->get();
        return view('generalManager.employees.tasks', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::where('company_id', Auth::guard('company_general_manager')->id())->get();
        return view('generalManager.employees.create', compact('branches'));
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

        return redirect()->route('generalManagerEmployees.index')->with('success', 'تم الاضافة بنجاح');
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
        return view('generalManager.employees.show', compact('employee'));
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
        $branches = Branch::where('company_id', Auth::guard('company_general_manager')->id())->get();
        return view('generalManager.employees.edit', compact('employee', 'branches'));
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
        return redirect()->route('generalManagerEmployees.index')->with('success', 'تم التعديل بنجاح');
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
        return redirect()->route('generalManagerEmployees.index')->with('success', 'تم الحذف بنجاح');
    }
}
