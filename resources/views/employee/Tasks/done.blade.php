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
                <h5 class="">المهام قيد الانتظار</h5>
                
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                    <tr>
                        <th>المهمه</th>
                        <th>التفاصيل</th>
                        <th>التاريخ</th>
                        <th>الملف المرفق</th>
                        <th>الحالة</th>
                    </tr>
                    </thead>

                    <tbody>
                        {{-- @foreach($cities as $city) --}}
                        <tr>
                            <th>اختبار اختبار</th>
                            <th>
                                <a class="btn btn-dark col-sm-12" data-toggle="modal" data-target="#description1">التفاصيل</a><br>
                            </th>
                            <th>11/11/2020</th>
                            <th>                                
                                <a class="btn btn-dark col-sm-12" data-toggle="modal" data-target="#file1">الملف المرفق</a><br>
                            </th>
                            <th>جيدة</th>
                        </tr>
                        {{-- @endforeach --}}

                        
                    </tbody>
                </table>
{{-- @foreach($specializations as $specializationn) --}}
<div class="modal fade" id="description1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="descriptionLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header backgroundColor text-white" style="border:none">
                <h5 class="modal-title" style="color: black" id="descriptionLabel1">تفاصيل الشكوى</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body backgroundColorSec p-5">
                <h6>تفااااااصيل</h6>
            </div>
        
        </div>
    </div>
</div>

<div class="modal fade" id="file1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="fileLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header backgroundColor text-white" style="border:none">
                <h5 class="modal-title" style="color: black" id="fileLabel1">الملف المرفق</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body backgroundColorSec p-5">
                
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