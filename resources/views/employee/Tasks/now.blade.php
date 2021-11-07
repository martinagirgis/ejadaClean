@extends("layouts.employee")
@section("pageTitle", "Ejada")
@section("style")
    <link href="{{asset("assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>

@endsection
@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <h5 class="">المهام الحالية</h5>
                <div class="row m-5">
                    <div class='form-group col-6 row'>
                        <label for="example-text-input" class="col-sm-2 col-form-label">بحث بالتاريخ </label>
                        <div class="col-sm-10">
                            <input class="form-control" id="date" type="date" id="example-text-input" value="{{isset($id) ? $id : ''}}" name="datee" onchange="getTask()" required>
                        </div>
                    </div>
                </div>
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                    <tr>
                        <th>المهمه</th>
                        <th>التفاصيل</th>
                        <th>التاريخ و الوقت</th>
                        <th>المدة</th>
                        <th>الوقت المتبقي</th>
                        <th>تسليم</th>
                    </tr>
                    </thead>

                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <th>{{$task->title}}</th>
                            <th>
                                <a class="btn btn-dark col-sm-12" onclick="modelDes('{{$task->id}}','{{$task->description}}')" data-toggle="modal" data-target="#images{{$task->id}}">التفاصيل</a><br>
                            </th>
                            
                            <?php
                            date_default_timezone_set('Africa/Cairo');

                            $combinedDT = date('Y-m-d H:i:s', strtotime("$task->date $task->time"));
                            
$minutes_to_add = $task->period;
$time = new DateTime($combinedDT);
$time->setTimezone(new DateTimeZone('Africa/Cairo'));
$time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
$timestamp = $time->format("Y/m/d H:i:s");
                            $datetime1 = strtotime(now());
                            $datetime2 = strtotime($timestamp);

                            $secs = $datetime1 - $datetime2;// == <seconds between the two times>
                            $minute = $secs / 60;
                            $days = $secs / 86400;

                            ?>
                            <th>{{date('Y-m-d h:i:s A', strtotime("$task->date $task->time"))}}</th>
                            <th>{{$task->period}} دقيقة</th>
                            @if(intval($minute) > 0)
                            <th>
                                <a class="btn btn-danger w-50 m-auto" onclick="modelTime('{{$task->id}}','انتهت منذ {{intval($minute)}} دقيقة')" data-toggle="modal" data-target="#times{{$task->id}}">انتهت</a><br>
                            </th>
                            <!--<th class="btn btn-danger w-50 m-auto">انتهت منذ {{intval($minute)}} دقيقة</th>-->
                                @if($task->state == 7)
                                    <th>                                
                                        <a class="btn btn-dark col-sm-12" >تم طلب مد الوقت</a><br>
                                    </th>
                                @else
                                    <th>                                
                                        <a class="btn btn-dark col-sm-12" href="{{route('tasksDelay',['id' => $task->id])}}">طلب مد الوقت</a><br>
                                    </th>
                                @endif
                            @else
                            <th>
                                <a class="btn btn-success w-50 m-auto" onclick="modelTime('{{$task->id}}','متبقي  {{intval($minute)}} دقيقة')" data-toggle="modal" data-target="#times{{$task->id}}">متاحة</a><br>
                            </th>
                            <!--<th class="btn btn-success w-50 m-auto">متبقي {{abs(intval($minute))}} دقيقة</th>-->
                                @if(abs(intval($minute)) > $task->period)
                                <th>                                
                                    <a class="btn btn-dark col-sm-12" onclick="alert('تسليم المهمة غير متاحة الان')">تسليم</a><br>
                                </th>
                                @else
                                <th>                                
                                    <a class="btn btn-dark col-sm-12" href="{{route('tasksSend',['id' => $task->id])}}">تسليم</a><br>
                                </th>
                                @endif
                            @endif
                           
                            

                        </tr>
                        @endforeach

                        
                    </tbody>
                </table>


<div id="modelImagee">

</div>

<div id="modelFile">

</div>
{{-- @endforeach --}}
            </div>
        </div>
    </div> <!-- end col --> 
</div>

@endsection
@section("script")
<script>
    function modelDes(x,y){
        document.getElementById('modelImagee').innerHTML =`
            <div class="modal " id="images`+x+`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">تفاصيل المهمة</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="group-img-container text-center post-modal">
                                `+ y +`
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                        </div>
                    </div>
                </div>
            </div>
        `
    }
    
    function modelTime(x,y){
        document.getElementById('modelImagee').innerHTML =`
            <div class="modal " id="times`+x+`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">الوقت المتبقي</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="group-img-container text-center post-modal">
                                `+ y +`
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                        </div>
                    </div>
                </div>
            </div>
        `
    }

</script>
<script>
    function getTask()
    {
        $date = document.getElementById('date').value;
        location.href = '/employee/taskNow/searsh/' + $date;
    }
</script>
<script src="{{asset("assets/admin/libs/datatables.net/js/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/datatables.net-buttons/js/dataTables.buttons.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/jszip/jszip.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/pdfmake/build/pdfmake.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/pdfmake/build/vfs_fonts.js")}}"></script>
<script src="{{asset("assets/admin/libs/datatables.net-buttons/js/buttons.html5.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/datatables.net-buttons/js/buttons.print.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/datatables.net-buttons/js/buttons.colVis.min.j")}}"></script>
<script src="{{asset("assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js")}}"></script>
<script src="{{asset("assets/admin/js/pages/datatables.init.js")}}"></script>
@endsection