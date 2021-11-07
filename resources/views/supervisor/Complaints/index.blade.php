@extends("layouts.supervisor")
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
                <h5 class="">الشكاوي</h5>
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
                        <th>الملف</th>
                        <th>الموظف</th>
                        <th>الحالة</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>

                    <tbody>
                        @foreach(Auth::guard('supervisor')->user()->employee as $employee)
                            @for($i = 0; $i < count($employee->complaints); $i++)
                            
                                @if (isset($id) ? date('Y-m-d', strtotime($employee->complaints[$i]->created_at)) == $id : ' ')
                                 
                                    <tr>
                                        <th>{{$employee->complaints[$i]->title}}</th>
                                        <th>
                                            <a class="btn btn-dark col-sm-12" data-toggle="modal" data-target="#description{{$employee->complaints[$i]->id}}">التفاصيل</a><br>
                                        </th>
                                        <th>
                                            <a class="btn btn-dark col-sm-12" data-toggle="modal" data-target="#file{{$employee->complaints[$i]->id}}">الملف المرفق</a><br>
                                        </th>
                                        <th>{{$employee->name}}</th>
                                        @if($employee->complaints[$i]->state == 1)
                                        <th>انتظار من المشرف</th>
                                        <th>
                                            <a class="btn btn-dark col-sm-5 mr-2" href="{{route('supervisor.Complaint.accept',['id'=>$employee->complaints[$i]->id])}}">ارسال للمدير</a>
                                            <a class="btn btn-dark col-sm-5" href="{{route('supervisor.Complaint.refused',['id'=>$employee->complaints[$i]->id])}}">رفض</a>
                                        </th>
                                        @elseif($employee->complaints[$i]->state == 2)
                                        <th>انتظار من المدير</th>
                                        <th>لا يمكن التحكم</th>
                                        @elseif($employee->complaints[$i]->state == 3)
                                        <th>مقبولة</th>
                                        <th>لا يمكن التحكم</th>
                                        @elseif($employee->complaints[$i]->state == 4)
                                        <th>مرفوض من المدير</th>
                                        <th>لا يمكن التحكم</th>
                                        @elseif($employee->complaints[$i]->state == 5)
                                        <th>مرفوض من المشرف</th>
                                        <th>لا يمكن التحكم</th>
                                        @endif
                                    </tr>
                                @endif
                            @endfor
                        @endforeach

                        
                    </tbody>
                </table>
@foreach(Auth::guard('supervisor')->user()->employee as $employeee)
@for($i = 0; $i < count($employeee->complaints); $i++)
<div class="modal fade" id="description{{$employeee->complaints[$i]->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="descriptionLabel{{$employeee->complaints[$i]->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header backgroundColor text-white" style="border:none">
                <h5 class="modal-title" style="color: black" id="descriptionLabel{{$employeee->complaints[$i]->id}}">تفاصيل الشكوى</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body backgroundColorSec p-5">
                <h6>{{$employeee->complaints[$i]->description}}</h6>
            </div>
        
        </div>
    </div>
</div>

<div class="modal fade" id="file{{$employeee->complaints[$i]->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="fileLabel{{$employeee->complaints[$i]->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header backgroundColor text-white" style="border:none">
                <h5 class="modal-title" style="color: black" id="fileLabel{{$employeee->complaints[$i]->id}}">الملف المرفق</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body backgroundColorSec p-5">
                <?php
                $mime = mime_content_type(public_path('assets/attach/'. $employeee->complaints[$i]->attach));
                if(strstr($mime, "video/")){
                    $type = 'video';
                }else if(strstr($mime, "image/")){
                    $type = 'image';
                }    
                ?>
                @if($type == 'image')
                <div class="group-img-container text-center post-modal">
                    <img  src="{{asset('assets/attach/'. $employeee->complaints[$i]->attach)}}" alt="" class="group-img img-fluid " ><br>
                </div>
                @elseif($type == 'video')
                <div class="group-img-container text-center post-modal">
                    <video width="100%" height="340" controls>
                        <source src="{{URL::asset('/assets/attach/'. $employeee->complaints[$i]->attach)}}" type="video/mp4">
                    </video>
                </div>
                @endif
            </div>
        
        </div>
    </div>
</div>
@endfor
@endforeach
            </div>
        </div>
    </div> <!-- end col --> 
</div>
<script>
    function getTask()
    {
        $date = document.getElementById('date').value; 
        location.href = "/supervisor/complaints/index/searsh/" + $date;

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