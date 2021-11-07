@extends("layouts.cleanMaintananceManager")
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
                <h5 class="">المهمات</h5>
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
                        <th>العنوان</th>
                        <th>التفاصيل</th>
                        <th>التاريخ و الوقت</th>
                        <th>المدة</th>
                        {{-- <th>الملف</th> --}}
                        <th>نوع المسؤل</th>
                        <th>الموظف</th>
                        <th>الحالة</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>

                    <tbody>
                        @foreach($tasks as $task)                                
                            <tr>
                                <th>{{$task->title}}</th>
                                <th>
                                    <a class="btn btn-dark col-sm-12" data-toggle="modal" data-target="#description{{$task->id}}">التفاصيل</a><br>
                                </th>
                                <th>{{$task->date}} {{$task->time}}</th>
                                <th>{{$task->period}}</th>
                                {{-- <th>
                                    <a class="btn btn-dark col-sm-12" data-toggle="modal" data-target="#file{{$task->id}}">الملف المرفق</a><br>
                                </th> --}}
                                
                                @if($task->support_type == 0)
                                <th>عامل</th>
                                <th>{{$task->employee->name}}</th>
                                @elseif($task->support_type == 1)
                                <th>فريق خاص</th>
                                <th>{{$task->team->name}}</th>
                                @elseif($task->support_type == 2)
                                <th>شركة راعية</th>
                                <th>{{$task->company->name}}</th>
                                @endif

                                @if($task->state == 1)
                                <th>انتظار من العامل</th>
                                <th>
                                    <center>
                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    التحكم
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="btn btn-dark col-sm-12"  href="{{route('managerClean.PeriodicTasks.show',['id'=>$task->id])}}">عرض</a><br>
                                                    <a class="btn btn-dark col-sm-12"  href="{{route('managerClean.edit.PeriodicTasks',['id'=>$task->id])}}">تعديل</a>
                                                    <form method="post" action="{{route('managerClean.Delete.PeriodicTasks',['id'=>$task->id])}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-dark col-sm-12" >حذف</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </center>
                                </th>
                                @elseif($task->state == 2)
                                <th>انتظار من المشرف</th>
                                <th>
                                    <center>
                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    التحكم
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="btn btn-dark col-sm-12"  href="{{route('managerClean.PeriodicTasks.show',['id'=>$task->id])}}">عرض</a><br>
                                                    <a class="btn btn-dark col-sm-12" data-toggle="modal" data-target="#file{{$task->id}}">عرض المرفق</a><br>
                                                    <a class="btn btn-dark col-sm-12" href="{{route('managerClean.PeriodicTasks.accept',['id'=>$task->id])}}">قبول </a><br>
                                                    <a class="btn btn-dark col-sm-12" href="{{route('managerClean.PeriodicTasks.refused',['id'=>$task->id])}}">رفض</a><br>
                                                    <form method="post" action="{{route('managerClean.Delete.PeriodicTasks',['id'=>$task->id])}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-dark col-sm-12" >حذف المهمة</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </center>
                                </th>
                                @elseif($task->state == 3)
                                <th>مرفوضة من المشرف و في انتظار العامل</th>
                                <th><center>
                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
        
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                التحكم
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <a class="btn btn-dark col-sm-12"  href="{{route('managerClean.PeriodicTasks.show',['id'=>$task->id])}}">عرض</a><br>
                                                <a class="btn btn-dark col-sm-12"  href="{{route('managerClean.edit.PeriodicTasks',['id'=>$task->id])}}">تعديل</a>
                                                <form method="post" action="{{route('managerClean.Delete.PeriodicTasks',['id'=>$task->id])}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-dark col-sm-12" >حذف</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </center></th>
                                @elseif($task->state == 4)
                                <th>انتظار من المدير</th>
                                <th>
                                    <center>
                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    التحكم
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="btn btn-dark col-sm-12"  href="{{route('managerClean.PeriodicTasks.show',['id'=>$task->id])}}">عرض</a><br>
                                                    <a class="btn btn-dark col-sm-12" data-toggle="modal" data-target="#file{{$task->id}}">عرض المرفق</a><br>
                                                    <a class="btn btn-dark col-sm-12" href="{{route('managerClean.PeriodicTasks.accept',['id'=>$task->id])}}">قبول </a><br>
                                                    <a class="btn btn-dark col-sm-12" href="{{route('managerClean.PeriodicTasks.refused',['id'=>$task->id])}}">رفض</a><br>
                                                    <form method="post" action="{{route('managerClean.Delete.PeriodicTasks',['id'=>$task->id])}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-dark col-sm-12" >حذف المهمة</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </center>
                                </th>
                                @elseif($task->state == 5)
                                <th>مقبولة</th>
                                <th>
                                    <center>
                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    التحكم
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="btn btn-dark col-sm-12"  href="{{route('managerClean.PeriodicTasks.show',['id'=>$task->id])}}">عرض</a><br>
                                                    <form method="post" action="{{route('managerClean.Delete.PeriodicTasks',['id'=>$task->id])}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-dark col-sm-12" >حذف المهمة</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </center>
                                </th>
                                @elseif($task->state == 6)
                                <th>مرفوض من المدير</th>
                                <th>
                                    <center>
                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    التحكم
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="btn btn-dark col-sm-12"  href="{{route('managerClean.PeriodicTasks.show',['id'=>$task->id])}}">عرض</a><br>
                                                    <form method="post" action="{{route('managerClean.Delete.PeriodicTasks',['id'=>$task->id])}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-dark col-sm-12" >حذف المهمة</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </center>
                                </th>
                                @elseif($task->state == 7)
                                <th>انتظار العامل بعد الرفض</th>
                                <th>
                                    <center>
                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    التحكم
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="btn btn-dark col-sm-12"  href="{{route('managerClean.PeriodicTasks.show',['id'=>$task->id])}}">عرض</a><br>
                                                    <form method="post" action="{{route('managerClean.Delete.PeriodicTasks',['id'=>$task->id])}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-dark col-sm-12" >حذف المهمة</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </center>
                                </th>
                                @endif
                            </tr>
                        @endforeach

                        
                    </tbody>
                </table>
@foreach($tasks as $complaintt)
<div class="modal fade" id="description{{$complaintt->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="descriptionLabel{{$complaintt->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header backgroundColor text-white" style="border:none">
                <h5 class="modal-title" style="color: black" id="descriptionLabel{{$complaintt->id}}">تفاصيل المهمة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body backgroundColorSec p-5">
                <h6>{{$complaintt->description}}</h6>
            </div>
        
        </div>
    </div>
</div>
@if($complaintt->state == 4 || $complaintt->state == 2)
<div class="modal fade" id="file{{$complaintt->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="fileLabel{{$complaintt->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header backgroundColor text-white" style="border:none">
                <h5 class="modal-title" style="color: black" id="fileLabel{{$complaintt->id}}">الملف المرفق</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body backgroundColorSec p-5">
                <?php
                $mime = mime_content_type(public_path('assets/attach/'. $complaintt->attach));
                if(strstr($mime, "video/")){
                    $type = 'video';
                }else if(strstr($mime, "image/")){
                    $type = 'image';
                }    
                ?>
                @if($type == 'image')
                <div class="group-img-container text-center post-modal">
                    <img  src="{{asset('assets/attach/'. $complaintt->attach)}}" alt="" class="group-img img-fluid " ><br>
                </div>
                @elseif($type == 'video')
                <div class="group-img-container text-center post-modal">
                    <video width="100%" height="340" controls>
                        <source src="{{URL::asset('/assets/attach/'. $complaintt->attach)}}" type="video/mp4">
                    </video>
                </div>
                @endif

                <br>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-4 col-form-label">الملاحظات</label>
                    <div class="col-sm-8">
                        {{$complaintt->note}}
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>
@endif
@endforeach
            </div>
        </div>
    </div> <!-- end col --> 
</div>
<script>
    function getTask()
    {
        $date = document.getElementById('date').value;
        @if ($typee == 'index')
        location.href = "/managerClean/PeriodicTasks/index/searsh/" + $date;
            @elseif ($typee == 'now')
            location.href = "/managerClean/PeriodicTasks/now/searsh/" + $date;

        @endif 

    }
</script>
@endsection
@section("script")
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