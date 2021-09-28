<?php

namespace App\Http\Controllers\GeneralManager;

use App\models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\models\CleanMantananceManager;

class CleanMaintananceManagerController extends Controller
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
        return view('generalManager.cleanMaintananceManagers.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::where('company_id', Auth::guard('company_general_manager')->id())->get();
        return view('generalManager.cleanMaintananceManagers.create', compact('branches'));
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
            'email' => ['required', 'email', 'max:255', 'unique:clean_mantanance_managers'],
        ];

        $this->validate($request,$rules);
        CleanMantananceManager::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'real_password' => $request->password,
            'phone' => $request->phone,
            'job_num' => $request->job_num,
            'id_num' => $request->id_num,
            'branch_id' => $request->branch_id,
        ]);
        return redirect()->route('cleanMaintananceManagers.index')->with('success', 'تم الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cleanMantananceManager = CleanMantananceManager::find($id);
        return view('generalManager.cleanMaintananceManagers.show', compact('cleanMantananceManager'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cleanMantananceManager = CleanMantananceManager::find($id);
        $branches = Branch::where('company_id', Auth::guard('company_general_manager')->id())->get();
        return view('generalManager.cleanMaintananceManagers.edit', compact('cleanMantananceManager', 'branches'));
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
        $cleanMantananceManager = CleanMantananceManager::find($id);

        $rules = [
            'email' => ['required', 'email', 'max:255', 'unique:clean_mantanance_managers,email,' . $cleanMantananceManager->id ],
        ];

        $this->validate($request,$rules);

        $cleanMantananceManager->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'real_password' => $request->password,
            'phone' => $request->phone,
            'job_num' => $request->job_num,
            'id_num' => $request->id_num,
        ]);
        return redirect()->route('cleanMaintananceManagers.index')->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $old = CleanMantananceManager::find($id);
        $old->delete();
        return redirect()->route('cleanMaintananceManagers.index')->with('success', 'تم الحذف بنجاح');
    }
}
