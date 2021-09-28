<?php

namespace App\Http\Controllers\GeneralManager;

use Illuminate\Http\Request;
use App\models\QualityManager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class QualityManagerController extends Controller
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
        $qualityManagers = QualityManager::where('company_id', Auth::guard('company_general_manager')->id())->get();
        return view('generalManager.qualityManageres.index', compact('qualityManagers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('generalManager.qualityManageres.create');
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
            'email' => ['required', 'email', 'max:255', 'unique:quality_managers'],
        ];

        $this->validate($request,$rules);
        QualityManager::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'real_password' => $request->password,
            'phone' => $request->phone,
            'job_num' => $request->job_num,
            'id_num' => $request->id_num,
            'company_id' => Auth::guard('company_general_manager')->id(),
        ]);
        return redirect()->route('qualityManagers.index')->with('success', 'تم الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $qualityManager = QualityManager::find($id);
        return view('generalManager.qualityManageres.show', compact('qualityManager'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $qualityManager = QualityManager::find($id);
        return view('generalManager.qualityManageres.edit', compact('qualityManager'));
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
        $qualityManager = QualityManager::find($id);

        $rules = [
            'email' => ['required', 'email', 'max:255', 'unique:quality_managers,email,' . $qualityManager->id ],
        ];

        $this->validate($request,$rules);

        $qualityManager->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'real_password' => $request->password,
            'phone' => $request->phone,
            'job_num' => $request->job_num,
            'id_num' => $request->id_num,
        ]);
        return redirect()->route('qualityManagers.index')->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $old = QualityManager::find($id);
        $old->delete();
        return redirect()->route('qualityManagers.index')->with('success', 'تم الحذف بنجاح');
    }
}
