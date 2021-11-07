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
                <br><br>
                <form method="get" action="{{route('add.periodic.task')}}">
                    @csrf
                <div class="row">
                    <div class='form-group col-6 row'>
                        <label for="example-text-input" class="col-sm-2 col-form-label">التاريخ</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="date" type="date" id="example-text-input" value="{{$id}}" name="datee" onchange="getTask()" required>
                        </div>
                    </div> 

                    <div class="form-group col-6 row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-dark w-25">اضافة</button>
                        </div>
                    </div>
                </div>
                </form>
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                    <tr>
                        <th>المرفق</th>
                        <th>العنوان</th>
                        <th>التفاصيل</th>
                        <th>الوقت</th>
                        <th>المدة</th>
                        <th>الموظف</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)   
                        @for($t = 0; $t < count($task); $t++)
                            
{{-- {{dd($tasks)}} --}}

                            <tr>
                                <th>{{$task[$t]->facility->name}}</th>
                                <th>{{$task[$t]->title}}</th>
                                <th>
                                    <a class="btn btn-dark col-sm-12" data-toggle="modal" data-target="#description{{$task[$t]->id}}">التفاصيل</a><br>
                                </th>

                                <th>{{$task[$t]->time}}</th>
                                <th>{{$task[$t]->period}}</th>
                                <th>{{$task[$t]->employee->name}}</th>

                            </tr>
                            @endfor    

                        @endforeach

                        
                    </tbody>
                </table>
@foreach($tasks as $complaintt)
    @for($i = 0; $i < count($complaintt); $i++)
        <div class="modal fade" id="description{{$complaintt[$i]->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="descriptionLabel{{$complaintt[$i]->id}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header backgroundColor text-white" style="border:none">
                        <h5 class="modal-title" style="color: black" id="descriptionLabel{{$complaintt[$i]->id}}">تفاصيل المهمة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body backgroundColorSec p-5">
                        <h6>{{$complaintt[$i]->description}}</h6>
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
        location.href = '/managerCleanTask/confirmPeriodicTask/' + $date;
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