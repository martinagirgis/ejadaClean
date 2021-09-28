<?php

namespace App\Http\Controllers\CleanMaintananceManager;

use App\models\Task;
use Illuminate\Http\Request;
use App\models\SponsorintCompany;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SponsoringCompaniesController extends Controller
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
        $companies = SponsorintCompany::where('clean_mantanance_manager_id', Auth::guard('clean_mantanance_manager')->id())->get();
        return view('cleanMaintananceManager.sponsoringCompanies.index', compact('companies'));
    }

    public function allTasks($id)
    {
        $tasks = Task::where('support_id', $id)->where('support_type', 'company')->get();
        return view('cleanMaintananceManager.sponsoringCompanies.tasks', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cleanMaintananceManager.sponsoringCompanies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SponsorintCompany::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'job_num' => $request->job_num,
            'id_num' => $request->id_num,
            'clean_mantanance_manager_id' => Auth::guard('clean_mantanance_manager')->id(),
        ]);
        return redirect()->route('sponsoringCompanies.index')->with('success', 'تم الاضافة بنجاح');
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
        $company = SponsorintCompany::find($id);
        return view('cleanMaintananceManager.sponsoringCompanies.edit', compact('company'));
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
        $company = SponsorintCompany::find($id);

        $company->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'job_num' => $request->job_num,
            'id_num' => $request->id_num,
        ]);
        return redirect()->route('sponsoringCompanies.index')->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $old = SponsorintCompany::find($id);
        $old->delete();
        return redirect()->route('sponsoringCompanies.index')->with('success', 'تم الحذف بنجاح');
    }
}
