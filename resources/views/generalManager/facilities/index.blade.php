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
                <h5 class="">المرافق</h5>
                
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                    <tr>
                        <th>اسم المرفق</th>
                        <th>النظافة الدورية</th>
                        <th>الصيانة الدورية</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>

                    <tbody>
                        {{-- @foreach($cities as $city) --}}
                        <tr>
                        <th>اختبار اختبار</th>
                        <th>
                            <a class="btn btn-dark col-sm-12" data-toggle="modal" data-target="#facilitiesCleantime1">المواعيد</a><br>
                        </th>
                        <th>
                            <a class="btn btn-dark col-sm-12" data-toggle="modal" data-target="#facilitiesMantanancetime1">المواعيد</a><br>
                        </th>
                        <th> 
                            <center>
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
    
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            التحكم
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="btn btn-dark col-sm-12"  href="{{route('generalManagerFacilities.edit',['generalManagerFacility'=>1])}}">تعديل</a>
                                            <form method="post" action="{{route('generalManagerFacilities.destroy',['generalManagerFacility'=>1])}}">
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
<div class="modal fade" id="facilitiesCleantime1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="facilitiesCleantimeLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header backgroundColor text-white" style="border:none">
                <h5 class="modal-title" style="color: black" id="facilitiesCleantimeLabel1">النظافة الدورية</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body backgroundColorSec p-5">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">اليوم</th>
                        <th scope="col">التوقيت</th>
                        <th scope="col">مدة التسليم</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>السبت</td>
                        <td>
                            12
                            <br>
                            3
                            <br>
                            6
                        </td>
                        <td>20 دقيقه
                            <br>
                            30 دقيقه
                            <br>
                            16 دقيقه
                        </td>
                    </tr>
                    </tbody>
                </table>
                <a class="btn btn-dark col-sm-12"  href="{{route('generalManager.facilities.cleanAddtimes',['facility'=>1])}}">اضافة مواعيد</a>
            </div>
        
        </div>
    </div>
</div>

<div class="modal fade" id="facilitiesMantanancetime1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="facilitiesMantanancetimeLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header backgroundColor text-white" style="border:none">
                <h5 class="modal-title" style="color: black" id="facilitiesMantanancetimeLabel1">الصيانة الدورية</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body backgroundColorSec p-5">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">اليوم</th>
                        <th scope="col">التوقيت</th>
                        <th scope="col">مدة التسليم</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>السبت</td>
                        <td>
                            12
                            <br>
                            3
                            <br>
                            6
                        </td>
                        <td>20 دقيقه
                            <br>
                            30 دقيقه
                            <br>
                            16 دقيقه
                        </td>
                    </tr>
                    </tbody>
                </table>
                <a class="btn btn-dark col-sm-12"  href="{{route('generalManager.facilities.mantananceAddtimes',['facility'=>1])}}">اضافة مواعيد</a>
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