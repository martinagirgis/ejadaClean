<?php

namespace App\Http\Controllers\Api\Employee;

use App\models\periodicTask;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PeriodicTasksController extends Controller
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
    public function tasksDone()
    { 
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiSupervisors') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
        $tasks = periodicTask::where('support_type','0')->where('support_id',$this->checkGuard()->id())->whereIn('state',[5,6])->get();
        foreach($tasks as $task)
            {
                $task->attach = 'https://fixit4maint.com/assets/attach/' . $task->attach;
                unset(
                    $task->support_type,
                    $task->support_id,
                    $task->facility_id,
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
                        $task->state = 'انتظار العامل بعد الرفض';
                        break;
                
                    default:
                        # code...
                        break;
                }
            }
            return $this->returndata(['Tasks'], [$tasks], "return all tasks success" );
        }
    }

    public function taskWaiting()
    {
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiSupervisors') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $tasks = periodicTask::where('support_type','0')->where('support_id',$this->checkGuard()->id())->whereIn('state',[2,4])->get();
            foreach($tasks as $task)
            {
                $task->attach = 'https://fixit4maint.com/assets/attach/' . $task->attach;
                unset(
                    $task->support_type,
                    $task->support_id,
                    $task->facility_id,
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
                        $task->state = 'انتظار العامل بعد الرفض';
                        break;
                
                    default:
                        # code...
                        break;
                }
            }
            return $this->returndata(['Tasks'], [$tasks], "return all tasks success" );
        }
    }

    public function taskNow()
    {
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiSupervisors') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $tasks = periodicTask::where('support_type','0')->where('support_id',$this->checkGuard()->id())->whereIn('state',[1,3,7,8])->get();
            foreach($tasks as $task)
            {
                $task->attach = 'https://fixit4maint.com/assets/attach/' . $task->attach;
                unset(
                    $task->support_type,
                    $task->support_id,
                    $task->attach,
                    $task->note,
                    $task->facility_id,
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

                date_default_timezone_set('Africa/Cairo');

                $combinedDT = date('Y-m-d H:i:s', strtotime("$task->date $task->time"));
                            
                $minutes_to_add = $task->period;
                $time = new \DateTime($combinedDT);
                $time->setTimezone(new \DateTimeZone('Africa/Cairo'));
                $time->add(new \DateInterval('PT' . $minutes_to_add . 'M'));
                $timestamp = $time->format("Y/m/d H:i:s");
                $datetime1 = strtotime(now());
                $datetime2 = strtotime($timestamp);

                $secs = $datetime1 - $datetime2;// == <seconds between the two times>
                $minute = $secs / 60;

                if(intval($minute) > 0)
                {
                    $task->remainingTime = " انتهت منذ " . intval(abs($minute)) . " دقيقة ";
                    if($task->state == 7)
                    {
                        $task->controleBtn = "تم طلب مد الوقت";
                    }
                    else
                    {
                        $task->controleBtn = " طلب مد الوقت";
                    }

                }
                else
                {
                    $task->remainingTime = " متبقي " . intval(abs($minute)) . " دقيقة ";
                    if(abs(intval($minute)) > $task->period)
                    {
                        $task->controleBtn = "تسليم المهمة غير متاحة الان";
                    }
                    else
                    {
                        $task->controleBtn = "تسليم ";
                    }
                }

                
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
                        $task->state = 'انتظار العامل بعد الرفض';
                        break;
                
                    default:
                        # code...
                        break;
                }
                        
            }
            return $this->returndata(['Tasks'], [$tasks], "return all tasks success" );
        }
    }

    public function tasksSendStore(Request $request)
    {
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiSupervisors') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $task = periodicTask::find($request->id);

            $request->validate([
                'file' => 'required',
            ]);
    
            $title = time().'.'.request()->file->getClientOriginalExtension();
        
            $request->file->move(public_path('assets/attach'), $title);

            $task->update([
                    'note' => $request->note,
                    'attach' => $title,
                    'state' => '2'
                ]);
    
            return $this->returnSuccessMessage('Task sent successfuly', 200);
        }
    }

    public function tasksDelay($id)
    {
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiSupervisors') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $task = periodicTask::find($id);

        $task->update([
                'state' => '7'
            ]);

            return $this->returnSuccessMessage('Task sent successfuly', 200);
        }
    }

    public function periodicTaskShow($id)
    {
        if ($this->checkGuard() == 'false' || $this->checkGuard() == 'apiSupervisors') {
            return $this->returnError(401, 'enter valid token');
        }
        else {
            $task = periodicTask::find($id);
            $task->attach = 'https://fixit4maint.com/assets/attach/' . $task->attach;
                unset(
                    $task->support_type,
                    $task->support_id,
                    $task->facility_id,
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
                        $task->state = 'انتظار العامل بعد الرفض';
                        break;
                
                    default:
                        # code...
                        break;
                }
            return $this->returndata(['Task'], [$task], "return all tasks success" );
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

}
