<?php

namespace App\Http\Controllers\Employee;

use App\models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\ComplaintsList;
use App\models\Facility;
use Illuminate\Support\Facades\Auth;

class ComplaintsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complaints = Complaint::where('employee_id', Auth::guard('employee')->id())->get();
        return view('employee.Complaints.index', compact('complaints'));
    }

    public function complaintsSearsh($id)
    {
        $complaints = Complaint::where('employee_id', Auth::guard('employee')->id())->whereDate('created_at',$id)->get();
        return view('employee.Complaints.index',compact('complaints','id'));
        // return $complaints;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facilities = Facility::where('branch_id', Auth::guard('employee')->user()->supervisor->cleanManager->branch->id)->get();
        return view('employee.Complaints.create', compact('facilities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1->bending supervisor
        //2->bending manager
        //3->acceped manager
        //4->refused manager
        //5->refused supervisor
        // return 1;
        $request->validate([
            'file' => 'required',
        ]);
 
       $title = time().'.'.request()->file->getClientOriginalExtension();
  
       $request->file->move(public_path('assets/attach'), $title);

       $titlecomplaint = ComplaintsList::find($request->title); 
$xx = Complaint::create([
        'title' => $titlecomplaint->name,
        'description' => $request->description,
        'attach' => $title,
        'type' => $request->type,
        'employee_id' => Auth::guard('employee')->id(),
        'branch_id' => Auth::guard('employee')->user()->supervisor->cleanManager->branch->id,
        'facility_id' => $request->facility_id,
        'state' => '1',
       ]);
       
       return $xx;
  
        return response()->json(['success'=>'File Uploaded Successfully']);
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
        return view('employee.Complaints.edit');
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

    public function getComplaintsLists(Request $request)
    {
        if ($request->type =='0') {
            $request->type = 'صيانة';
        }
        elseif($request->type =='1'){
            $request->type = 'نظافة';
        }
        $complaintsList = ComplaintsList::where('facility_id', $request->facility_id)->where('type', $request->type)->get();
        return response()->json($complaintsList);
        // return 9;
    }

}
