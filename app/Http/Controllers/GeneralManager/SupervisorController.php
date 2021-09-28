<?php

namespace App\Http\Controllers\GeneralManager;

use App\models\Branch;
use App\models\Supervisor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SupervisorController extends Controller
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
        return view('generalManager.supervisors.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::where('company_id', Auth::guard('company_general_manager')->id())->get();
        return view('generalManager.supervisors.create', compact('branches'));
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
            'email' => ['required', 'email', 'max:255', 'unique:supervisors'],
        ];

        $this->validate($request,$rules);
        Supervisor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'real_password' => $request->password,
            'phone' => $request->phone,
            'job_num' => $request->job_num,
            'id_num' => $request->id_num,
            'area' => $request->area,
            'clean_mantanance_manager_id' => $request->clean_mantanance_manager_id,
        ]);
        return redirect()->route('generalManagerSupervisors.index')->with('success', 'تم الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supervisor = Supervisor::find($id);
        return view('generalManager.supervisors.show', compact('supervisor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supervisor = Supervisor::find($id);
        $branches = Branch::where('company_id', Auth::guard('company_general_manager')->id())->get();
        return view('generalManager.supervisors.edit', compact('supervisor', 'branches'));
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
        $supervisor = Supervisor::find($id);

        $rules = [
            'email' => ['required', 'email', 'max:255', 'unique:supervisors,email,' . $supervisor->id ],
        ];

        $this->validate($request,$rules);

        $supervisor->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'real_password' => $request->password,
            'phone' => $request->phone,
            'job_num' => $request->job_num,
            'id_num' => $request->id_num,
            'area' => $request->area,
            'clean_mantanance_manager_id' => $request->clean_mantanance_manager_id,
        ]);
        return redirect()->route('generalManagerSupervisors.index')->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $old = Supervisor::find($id);
        $old->delete();
        return redirect()->route('generalManagerSupervisors.index')->with('success', 'تم الحذف بنجاح');
    }
}
