@extends("layouts.supervisor")
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
                <h5 class="">العمال</h5>
                
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>البريد الالكتروني</th>
                        <th>الهاتف</th>
                        <th>نوع العمل</th>
                        {{-- <th>المشرف التابع له</th> --}}
                        {{-- <th>المهام</th> --}}
                        <th>التحكم</th>
                    </tr>
                    </thead>

                    <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <th>{{$employee->name}}</th>
                                <th>{{$employee->email}}</th>
                                <th>{{$employee->phone}}</th>
                                @if($employee->type == '0')
                                    <th>عامل صيانة</th>
                                @elseif($employee->type == '1')
                                    <th>عامل نظافة</th>
                                @endif
                                {{-- <th>{{$employee->supervisor->name}}</th> --}}
                                {{-- <th>
                                    <a class="btn btn-dark col-sm-12"  href="{{route('supervisorEmployees.tasks',['id'=>$employee->id])}}">عرض</a>
                                </th> --}}
                                <th> 
                                    <center>
                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    التحكم
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="btn btn-dark col-sm-12"  href="{{route('supervisorEmployees.show',['supervisorEmployee'=>$employee->id])}}">عرض</a><br>
                                                    <a class="btn btn-dark col-sm-12"  href="{{route('supervisorEmployees.edit',['supervisorEmployee'=>$employee->id])}}">تعديل</a>
                                                    <form method="post" action="{{route('supervisorEmployees.destroy',['supervisorEmployee'=>$employee->id])}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-dark col-sm-12" >حذف</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </center>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col --> 
</div>

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