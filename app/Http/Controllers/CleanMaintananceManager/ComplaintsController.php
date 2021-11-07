<?php

namespace App\Http\Controllers\CleanMaintananceManager;

use App\models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ComplaintsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:clean_mantanance_manager');
    }

    public function index()
    {
        $typee = 'index';
        $complaints = Complaint::where('branch_id', Auth::guard('clean_mantanance_manager')->user()->branch->id)->get();
        return view('cleanMaintananceManager.Complaints.index', compact('complaints','typee'));
    }

    public function ComplaintNow()
    {
        $typee = 'now';
        $complaints = Complaint::where('branch_id', Auth::guard('clean_mantanance_manager')->user()->branch->id)->where('state','1')->get();
        return view('cleanMaintananceManager.Complaints.index', compact('complaints','typee'));
    }

    public function indexSerch($id)
    {
        $typee = 'index';
        $complaints = Complaint::where('branch_id', Auth::guard('clean_mantanance_manager')->user()->branch->id)->whereDate('created_at',$id)->get();
        return view('cleanMaintananceManager.Complaints.index', compact('complaints','id','typee'));
    }

    public function nowSearsh($id)
    {
        $typee = 'now';
        $complaints = Complaint::where('branch_id', Auth::guard('clean_mantanance_manager')->user()->branch->id)->where('state','1')->whereDate('created_at',$id)->get();
        return view('cleanMaintananceManager.Complaints.index', compact('complaints','id','typee'));
    }

    public function ComplaintAccept($id)
    {
        $complaint = Complaint::find($id);
        $complaint->update([
            'state' => '3',
        ]);

        return redirect()->route('managerClean.createTaskComplaint',['id' => $id])->with('success','تم قبول الطلب لعمل مهمة');
    }

    public function ComplaintRefused($id)
    {
        $complaint = Complaint::find($id);
        $complaint->update([
            'state' => '4',
        ]);

        return redirect()->back()->with('success','تم رفض الطلب ');
    }
}