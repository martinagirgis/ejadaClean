<?php

namespace App\Http\Controllers\Supervisor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Complaint;
use Illuminate\Support\Facades\Auth;

class ComplaintsController extends Controller
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
        //$complaints = Complaint::where('employee_id', Auth::guard('supervisor')->id())->get();
        return view('supervisor.Complaints.index');
    }

    public function indexSerch($id)
    {
        return view('supervisor.Complaints.index', compact('id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ComplaintNow()
    {
        return view('supervisor.Complaints.new');
    }

    public function nowSearsh($id)
    {
        return view('supervisor.Complaints.new', compact('id'));
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

    public function ComplaintAccept($id)
    {
        $complaint = Complaint::find($id);
        $complaint->update([
            'state' => '2',
        ]);

        return redirect()->back()->with('success','تم ارسال الطلب للمدير');
    }

    public function ComplaintRefused($id)
    {
        $complaint = Complaint::find($id);
        $complaint->update([
            'state' => '5',
        ]);

        return redirect()->back()->with('success','تم رفض الطلب ');
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
}
