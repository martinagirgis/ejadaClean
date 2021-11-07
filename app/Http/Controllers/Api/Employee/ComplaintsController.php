<?php

namespace App\Http\Controllers\Api\Employee;

use App\models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;

class ComplaintsController extends Controller
{
    use GeneralTrait;
    // public function __construct()
    // {
    //     $this->middleware('auth:employee');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiSupervisors') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $complaints = Complaint::where('employee_id', $this->checkGuard()->id())->get();
            foreach($complaints as $complaint)
            {
                $complaint->attach = 'https://fixit4maint.com/assets/attach/' . $complaint->attach;
                unset(
                    $complaint->employee_id,
                    $complaint->branch_id,
                    $complaint->created_at,
                    $complaint->updated_at,
                );
                
                switch ($complaint->state) {
                    case '1':
                        $complaint->state = 'pending from supervisor';
                        break;

                    case '2':
                        $complaint->state = 'pending from manager';
                        break;

                    case '3':
                        $complaint->state = 'pending from manager';
                        break; 
                        
                    case '4':
                        $complaint->state = 'pending from manager';
                        break;

                    case '5':
                        $complaint->state = 'pending from supervisor';
                        break;
                
                    default:
                        # code...
                        break;
                }
            }
            return $this->returndata(['Complaints'], [$complaints], "return all complaints success" );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.Complaints.create');
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
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiSupervisors') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            // return $this->checkGuard()->user()->supervisor->cleanManager->branch->id;
           
            // $request->validate([
            //     'file' => 'required',
            // ]);
    
            $title = time().'.'.request()->file->getClientOriginalExtension();
            $request->file->move(public_path('assets/attach'), $title);
           
            if ($request->type == 0) {
                $type = 'صيانة';
            }
            else {
                $type = 'نظافة';
            }
            Complaint::create([
                'title' => $request->title,
                'description' => $request->description,
                'attach' => $title,
                'type' => $type,
                'employee_id' =>$this->checkGuard()->id(),
                'branch_id' => $this->checkGuard()->user()->supervisor->cleanManager->branch->id,
                'state' => '1',
            ]);
            // return $this->checkGuard()->id();
            return $this->returnSuccessMessage('Complaint added successfuly', 200);
        }
    }

    public function checkGuard()
    {
        if(Auth::guard('apiEmployees')->check())
            {return Auth::guard('apiEmployees');}
        elseif(Auth::guard('apiSupervisors')->check())
            {return Auth::guard('apiSupervisors');}
        else {return 'false';}
        
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

}
