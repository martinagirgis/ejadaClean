<?php

namespace App\Http\Controllers\Api\Supervisor;

use App\models\Task;
use App\models\Employee;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends Controller
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
            $employees = Employee::where('supervisor_id',  $this->checkGuard()->id())->get();
            foreach($employees as $employee)
            {
                if ($employee->type == "0") {
                    $employee->type = 'صيانة';
                }
                else {
                    $employee->type = 'نظافة';
                }

                unset(
                    $employee->token,
                    $employee->supervisor_id,
                    $employee->created_at,
                    $employee->updated_at,
                );
                 
            }
            return $this->returndata(['Employees'], [$employees], "return all employees success" );
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
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiEmployees') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            Employee::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'real_password' => $request->password,
                'phone' => $request->phone,
                'job_num' => $request->job_num,
                'id_num' => $request->id_num,
                'type' => $request->type,
                'date' => $request->date,
                'supervisor_id' =>  $this->checkGuard()->id(),
            ]);
        }
        return $this->returnSuccessMessage('Employee added successfuly', 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiEmployees') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $employee = Employee::find($id);
            if ($employee->type == "0") {
                $employee->type = 'صيانة';
            }
            else {
                $employee->type = 'نظافة';
            }

            unset(
                $employee->token,
                $employee->supervisor_id,
                $employee->created_at,
                $employee->updated_at,
            );
            
            return $this->returndata(['Employee'], [$employee], "return employee success" );
        }
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
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiEmployees') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $employee = Employee::find($id);

            $employee->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'real_password' => $request->password,
                'phone' => $request->phone,
                'job_num' => $request->job_num,
                'id_num' => $request->id_num,
                'type' => $request->type,
                'date' => $request->date,
                'supervisor_id' => $this->checkGuard()->id(),
            ]);
        }

        //return $this->returnSuccessMessage('Employee updated successfuly', 200);
        return $this->returndata(['Employee'], [$employee], "return employee success" );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiEmployees') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $old = Employee::find($id);
            $old->delete();
        }
        return $this->returnSuccessMessage('Employee deleted successfuly', 200);
    }

}
