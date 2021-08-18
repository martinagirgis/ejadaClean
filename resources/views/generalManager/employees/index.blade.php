@extends("layouts.generalManager")
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
                <h5 class="">العمال</h5>
                
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>البريد الالكتروني</th>
                        <th>الهاتف</th>
                        <th>تاريخ الميلاد</th>
                        <th>نوع العمل</th>
                        <th>المشرف التابع له</th>
                        <th>المهام</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>

                    <tbody>
                        {{-- @foreach($cities as $city) --}}
                        <tr>
                        <th>اختبار اختبار</th>
                        <th>test@gmail.com</th>
                        <th>0120333000222</th>
                        <th>10/10/1000</th>
                        <th>صيانة</th>
                        <th>المشرف الاول</th>
                        <th>
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    المهام
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="btn btn-dark col-sm-12" data-toggle="modal" data-target="#employeeOldTasks1">المهام السابقة</a><br>
                                    <a class="btn btn-dark col-sm-12" data-toggle="modal" data-target="#employeeNewTasks1">المهام الحالية</a><br>
                                </div>
                            </div>
                        </th>
                        <th> 
                            <center>
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
    
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            التحكم
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="btn btn-dark col-sm-12"  href="{{route('generalManagerEmployees.edit',['generalManagerEmployee'=>1])}}">تعديل</a>
                                            <form method="post" action="{{route('generalManagerEmployees.destroy',['generalManagerEmployee'=>1])}}">
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
                        {{-- @endforeach --}}

                        
                    </tbody>
                </table>
{{-- @foreach($specializations as $specializationn) --}}
<div class="modal fade" id="employeeOldTasks1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="employeeOldTasksLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header backgroundColor text-white" style="border:none">
                <h5 class="modal-title" style="color: black" id="employeeOldTasksLabel1">المهام السابقة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body backgroundColorSec p-5">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">المهمه</th>
                        <th scope="col">التاريخ</th>
                        <th scope="col">الحالة</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>تنظيف المدخل</td>
                        <td>12/12/2020</td>
                        <td>جيدة</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>تنظيف المخازن</td>
                        <td>13/1/2021</td>
                        <td>تمت اعادتة</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        
        </div>
    </div>
</div>

<div class="modal fade" id="employeeNewTasks1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="employeeNewTasksLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header backgroundColor text-white" style="border:none">
                <h5 class="modal-title" style="color: black" id="employeeNewTasksLabel1">المهام الحالية</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body backgroundColorSec p-5">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">المهمه</th>
                        <th scope="col">التاريخ</th>
                        <th scope="col">الوقت المتبقي للمهمه</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>تنظيف المدخل</td>
                        <td>12/12/2020</td>
                        <td>120 دقيقه</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>تنظيف المخازن</td>
                        <td>13/1/2021</td>
                        <td>45 دقيقه</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        
        </div>
    </div>
</div>
{{-- @endforeach --}}
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