<?php

namespace App\Http\Controllers\Api\Supervisor;

use App\models\Employee;
use App\models\Complaint;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ComplaintsController extends Controller
{
    use GeneralTrait;

    public function checkGuard()
    {
        if(Auth::guard('apiEmployees')->check())
            {return Auth::guard('apiEmployees');}
        elseif(Auth::guard('apiSupervisors')->check())
            {return Auth::guard('apiSupervisors');}
        else {return 'false';}
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiEmployees') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $employees = Employee::where('supervisor_id', $this->checkGuard()->id())->get();
            $complaints = [];
            foreach($employees as $employee)
            {
                $comps = Complaint::where('employee_id', $employee->id)->get();
                foreach($comps as $comp)
                {
                    $comp->attach = 'https://fixit4maint.com/assets/attach/' . $comp->attach;
                    $comp->employee = $employee->name;
    
                    switch ($comp->state) {
                        case '1':
                            $comp->state = 'pending from supervisor';
                            break;
    
                        case '2':
                            $comp->state = 'pending from manager';
                            break;
    
                        case '3':
                            $comp->state = 'Accepted from manager';
                            break; 
                            
                        case '4':
                            $comp->state = 'Refused from manager';
                            break;
    
                        case '5':
                            $comp->state = 'Refused from supervisor';
                            break;
                    
                        default:
                            # code...
                            break;
                    }

                    unset(
                        $comp->branch_id,
                        $comp->employee_id,
                        // $comp->created_at,
                        $comp->updated_at,
                    );
                     
                }
                $complaints = array_merge( $complaints, $comps->toArray());
            }

            return $this->returndata(['complaints'], [$complaints], "return all complaint success" );
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ComplaintNow()
    {
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiEmployees') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $employees = Employee::where('supervisor_id', $this->checkGuard()->id())->get();
            $complaints = [];
            foreach($employees as $employee)
            {
                $comps = Complaint::where('employee_id', $employee->id)->where('state',1)->get();
                foreach($comps as $comp)
                {
                    $comp->attach = 'https://fixit4maint.com/assets/attach/' . $comp->attach;
                    $comp->employee = $employee->name;
    
                    switch ($comp->state) {
                        case '1':
                            $comp->state = 'pending from supervisor';
                            break;
    
                        case '2':
                            $comp->state = 'pending from manager';
                            break;
    
                        case '3':
                            $comp->state = 'Accepted from manager';
                            break; 
                            
                        case '4':
                            $comp->state = 'Refused from manager';
                            break;
    
                        case '5':
                            $comp->state = 'Refused from supervisor';
                            break;
                    
                        default:
                            # code...
                            break;
                    }

                    unset(
                        $comp->branch_id,
                        $comp->employee_id,
                        // $comp->created_at,
                        $comp->updated_at,
                    );
                     
                }
                $complaints = array_merge( $complaints, $comps->toArray());
            }
            
            return $this->returndata(['complaints'], [$complaints], "return all complaint success" );
        }
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
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiEmployees') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $complaint = Complaint::find($id);
            $complaint->update([
                'state' => '2',
            ]);

        }
        return $this->returnSuccessMessage('Complaint Accepted successfuly', 200);
    }

    public function ComplaintRefused($id)
    {
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiEmployees') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $complaint = Complaint::find($id);
            $complaint->update([
                'state' => '5',
            ]);

        }
        return $this->returnSuccessMessage('Complaint Refused successfuly', 200);
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
