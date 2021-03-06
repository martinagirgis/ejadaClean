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
        $tasks = Task::where('branch_id', Auth::guard('clean_mantanance_manager')->user()->branch->id)->where('support_type',2)->where('support_id',$id)->get();
        return view('cleanMaintananceManager.sponsoringCompanies.tasks', compact('tasks'));
    }

    public function showTask($id)
    {
        $task = Task::find($id);
        return view('cleanMaintananceManager.tasks.show', compact('task'));
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
        return redirect()->route('sponsoringCompanies.index')->with('success', '???? ?????????????? ??????????');
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
        return redirect()->route('sponsoringCompanies.index')->with('success', '???? ?????????????? ??????????');
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
        return redirect()->route('sponsoringCompanies.index')->with('success', '???? ?????????? ??????????');
    }
}
