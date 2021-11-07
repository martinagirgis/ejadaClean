<?php

namespace App\Http\Controllers\Api\Supervisor;

use App\models\Employee;
use App\models\periodicTask;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PeriodicTasksController extends Controller
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
    public function index()
    {
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiEmployees') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $employees = Employee::where('supervisor_id', $this->checkGuard()->id())->get();
            $tasks = [];
            foreach($employees as $employee)
            {
                $taskk = periodicTask::where('support_type', 0)->where('support_id', $employee->id)->get();
                foreach($taskk as $task)
                {
                    $task->attach = 'https://fixit4maint.com/assets/attach/' . $task->attach;
                    unset(
                        $task->support_type,
                        $task->support_id,
                        $task->branch_id,
                        $task->created_at,
                        $task->updated_at,
                    );

                    if ($task->type == "0") {
                        $type = 'صيانة';
                    }
                    else {
                        $type = 'نظافة';
                    }
                    $task->type = $type;
                    $task->employee = $employee->name;
                    switch ($task->state) {
                        case '1':
                            $task->state = 'انتظار من العامل';
                            break;

                        case '2':
                            $task->state = 'انتظار من المشرف';
                            break;

                        case '3':
                            $task->state = 'مرفوضة من المشرف و في انتظار العامل';
                            break; 
                            
                        case '4':
                            $task->state = 'انتظار من المدير';
                            break;

                        case '5':
                            $task->state = 'مقبولة';
                            break;

                        case '6':
                            $task->state = 'مرفوض من المدير';
                            break;

                        case '7':
                            $task->state = 'طلب مد وقت';
                            break;

                        case '8':
                            $task->state = 'المشرف وافق مد الوقت و في انتظار العامل';
                            break;

                        case '9':
                            $task->state = 'المشرف رفض مد الوقت';
                            break;
                    
                        default:
                            # code...
                            break;
                    }
                }
                $tasks = array_merge( $tasks, $taskk->toArray());
            }

            return $this->returndata(['tasks'], [$tasks], "return all tasks success" );
        }

    }
    
    public function new()
    {
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiEmployees') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $employees = Employee::where('supervisor_id', $this->checkGuard()->id())->get();
            $tasks = [];
            foreach($employees as $employee)
            {
                $taskk = periodicTask::whereIn('state', ['2'])->where('support_type', 0)->where('support_id', $employee->id)->get();
                foreach($taskk as $task)
                {
                    $task->attach = 'https://fixit4maint.com/assets/attach/' . $task->attach;
                    unset(
                        $task->support_type,
                        $task->support_id,
                        $task->branch_id,
                        $task->created_at,
                        $task->updated_at,
                    );

                    if ($task->type == "0") {
                        $type = 'صيانة';
                    }
                    else {
                        $type = 'نظافة';
                    }
                    $task->type = $type;
                    $task->employee = $employee->name;
                    switch ($task->state) {
                        case '1':
                            $task->state = 'انتظار من العامل';
                            break;

                        case '2':
                            $task->state = 'انتظار من المشرف';
                            break;

                        case '3':
                            $task->state = 'مرفوضة من المشرف و في انتظار العامل';
                            break; 
                            
                        case '4':
                            $task->state = 'انتظار من المدير';
                            break;

                        case '5':
                            $task->state = 'مقبولة';
                            break;

                        case '6':
                            $task->state = 'مرفوض من المدير';
                            break;

                        case '7':
                            $task->state = 'طلب مد وقت';
                            break;

                        case '8':
                            $task->state = 'المشرف وافق مد الوقت و في انتظار العامل';
                            break;

                        case '9':
                            $task->state = 'المشرف رفض مد الوقت';
                            break;
                    
                        default:
                            # code...
                            break;
                    }
                }
                $tasks = array_merge( $tasks, $taskk->toArray());
            }

            return $this->returndata(['tasks'], [$tasks], "return all tasks success" );
        }
    }

    public function denay()
    {
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiEmployees') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $employees = Employee::where('supervisor_id', $this->checkGuard()->id())->get();
            $tasks = [];
            foreach($employees as $employee)
            {
                $taskk = periodicTask::where('state', '7')->where('support_type', 0)->where('support_id', $employee->id)->get();
                foreach($taskk as $task)
                {
                    unset(
                        $task->attach,
                        $task->note,
                        $task->support_type,
                        $task->support_id,
                        $task->branch_id,
                        $task->created_at,
                        $task->updated_at,
                    );

                    if ($task->type == "0") {
                        $type = 'صيانة';
                    }
                    else {
                        $type = 'نظافة';
                    }
                    $task->type = $type;

                    $task->employee = $employee->name;
                    switch ($task->state) {
                        case '1':
                            $task->state = 'انتظار من العامل';
                            break;

                        case '2':
                            $task->state = 'انتظار من المشرف';
                            break;

                        case '3':
                            $task->state = 'مرفوضة من المشرف و في انتظار العامل';
                            break; 
                            
                        case '4':
                            $task->state = 'انتظار من المدير';
                            break;

                        case '5':
                            $task->state = 'مقبولة';
                            break;

                        case '6':
                            $task->state = 'مرفوض من المدير';
                            break;

                        case '7':
                            $task->state = 'طلب مد وقت';
                            break;

                        case '8':
                            $task->state = 'المشرف وافق مد الوقت و في انتظار العامل';
                            break;

                        case '9':
                            $task->state = 'المشرف رفض مد الوقت';
                            break;
                    
                        default:
                            # code...
                            break;
                    }
                }
                $tasks = array_merge( $tasks, $taskk->toArray());
            }

            return $this->returndata(['tasks'], [$tasks], "return all tasks success" );
        }
    }

    public function waiting()
    {
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiEmployees') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $employees = Employee::where('supervisor_id', $this->checkGuard()->id())->get();
            $tasks = [];
            foreach($employees as $employee)
            {
                $taskk = periodicTask::where('state', '4')->where('support_type', 0)->where('support_id', $employee->id)->get();
                foreach($taskk as $task)
                {
                    $task->attach = 'https://fixit4maint.com/assets/attach/' . $task->attach;
                    unset(
                        $task->support_type,
                        $task->support_id,
                        $task->branch_id,
                        $task->created_at,
                        $task->updated_at,
                    );

                    if ($task->type == "0") {
                        $type = 'صيانة';
                    }
                    else {
                        $type = 'نظافة';
                    }
                    $task->type = $type;
                    $task->employee = $employee->name;
                    switch ($task->state) {
                        case '1':
                            $task->state = 'انتظار من العامل';
                            break;

                        case '2':
                            $task->state = 'انتظار من المشرف';
                            break;

                        case '3':
                            $task->state = 'مرفوضة من المشرف و في انتظار العامل';
                            break; 
                            
                        case '4':
                            $task->state = 'انتظار من المدير';
                            break;

                        case '5':
                            $task->state = 'مقبولة';
                            break;

                        case '6':
                            $task->state = 'مرفوض من المدير';
                            break;

                        case '7':
                            $task->state = 'طلب مد وقت';
                            break;

                        case '8':
                            $task->state = 'المشرف وافق مد الوقت و في انتظار العامل';
                            break;

                        case '9':
                            $task->state = 'المشرف رفض مد الوقت';
                            break;
                    
                        default:
                            # code...
                            break;
                    }
                }
                $tasks = array_merge( $tasks, $taskk->toArray());
            }

            return $this->returndata(['tasks'], [$tasks], "return all tasks success" );
        }
    }

    public function waitingEmp()
    {
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiEmployees') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $employees = Employee::where('supervisor_id', $this->checkGuard()->id())->get();
            $tasks = [];
            foreach($employees as $employee)
            {
                $taskk = periodicTask::whereIn('state', ['1', '8'])->where('support_type', 0)->where('support_id', $employee->id)->get();
                foreach($taskk as $task)
                {
                    unset(
                        $task->attach,
                        $task->note,
                        $task->support_type,
                        $task->support_id,
                        $task->branch_id,
                        $task->created_at,
                        $task->updated_at,
                    );

                    if ($task->type == "0") {
                        $type = 'صيانة';
                    }
                    else {
                        $type = 'نظافة';
                    }
                    $task->type = $type;

                    $task->employee = $employee->name;
                    switch ($task->state) {
                        case '1':
                            $task->state = 'انتظار من العامل';
                            break;

                        case '2':
                            $task->state = 'انتظار من المشرف';
                            break;

                        case '3':
                            $task->state = 'مرفوضة من المشرف و في انتظار العامل';
                            break; 
                            
                        case '4':
                            $task->state = 'انتظار من المدير';
                            break;

                        case '5':
                            $task->state = 'مقبولة';
                            break;

                        case '6':
                            $task->state = 'مرفوض من المدير';
                            break;

                        case '7':
                            $task->state = 'طلب مد وقت';
                            break;

                        case '8':
                            $task->state = 'المشرف وافق مد الوقت و في انتظار العامل';
                            break;

                        case '9':
                            $task->state = 'المشرف رفض مد الوقت';
                            break;
                    
                        default:
                            # code...
                            break;
                    }
                }
                $tasks = array_merge( $tasks, $taskk->toArray());
            }

            return $this->returndata(['tasks'], [$tasks], "return all tasks success" );
        }
    }

    public function show($id)
    {
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiEmployees') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $task = periodicTask::find($id);
            $task->attach = 'https://fixit4maint.com/assets/attach/' . $task->attach;
            unset(
                $task->support_type,
                $task->support_id,
                $task->branch_id,
                $task->created_at,
                $task->updated_at,
            );

            if ($task->type == "0") {
                $type = 'صيانة';
            }
            else {
                $type = 'نظافة';
            }
            $task->type = $type;
            // $task->employee = $task->employee->name;
            switch ($task->state) {
                case '1':
                    $task->state = 'انتظار من العامل';
                    break;

                case '2':
                    $task->state = 'انتظار من المشرف';
                    break;

                case '3':
                    $task->state = 'مرفوضة من المشرف و في انتظار العامل';
                    break; 
                    
                case '4':
                    $task->state = 'انتظار من المدير';
                    break;

                case '5':
                    $task->state = 'مقبولة';
                    break;

                case '6':
                    $task->state = 'مرفوض من المدير';
                    break;

                case '7':
                    $task->state = 'طلب مد وقت';
                    break;

                case '8':
                    $task->state = 'المشرف وافق مد الوقت و في انتظار العامل';
                    break;

                case '9':
                    $task->state = 'المشرف رفض مد الوقت';
                    break;
            
                default:
                    # code...
                    break;
            }
            return $this->returndata(['task'], [$task], "return task success" );
        }
    }

    public function TaskAccept($id)
    {
        
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiEmployees') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $task = periodicTask::find($id);
            $task->update([
                'state' => '4',
            ]);

        }
        return $this->returnSuccessMessage('Task Accepted successfuly', 200);
    }

    public function renewTask(Request $request)
    {
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiEmployees') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $task = periodicTask::find($request->id);
            $task->update([
                'date' => $request->date,
                'time' => $request->time,
                'period' => $request->period,
                'state' => '3',
            ]);
        }
        return $this->returnSuccessMessage('Task Refused and Renew successfuly', 200);
    }

    public function TaskDelayRefused($id)
    {
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiEmployees') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $task = periodicTask::find($id);
            $task->update([
                'state' => '9',
            ]);

        }
        return $this->returnSuccessMessage('Task Refuced Delay successfuly', 200);
    }

    public function renewDelayTask(Request $request)
    {
        
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiEmployees') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $task = periodicTask::find($request->id);
            $task->update([
                'date' => $request->date,
                'time' => $request->time,
                'period' => $request->period,
                'state' => '8',
            ]);
        }
        return $this->returnSuccessMessage('Task Accepted Delay successfuly', 200);
    }

}
