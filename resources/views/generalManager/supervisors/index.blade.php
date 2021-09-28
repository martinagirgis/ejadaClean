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
                <h5 class="">المشرفين</h5>
                
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>البريد الالكتروني</th>
                        <th>الهاتف</th>
                        <th>مدير النظافة و الصيانه التابع له</th>
                        <th>المنطقة المسؤول عنها</th>
                        <th>الموظفين لدية</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>

                    <tbody>
                        @foreach($branches as $branch)
                            @for($i=0; $i < count($branch->cleanManager); $i++)
                            @for($y = 0; $y < count($branch->cleanManager[$i]->supervisor); $y++)
                                <tr>
                                    <th>{{$branch->cleanManager[$i]->supervisor[$y]->name}}</th>
                                    <th>{{$branch->cleanManager[$i]->supervisor[$y]->email}}</th>
                                    <th>{{$branch->cleanManager[$i]->supervisor[$y]->phone}}</th>
                                    <th>{{$branch->cleanManager[$i]->name}}</th>
                                    <th>{{$branch->cleanManager[$i]->supervisor[$y]->area}}</th>
                                    <th>
                                        <a class="btn btn-dark col-sm-12" data-toggle="modal" data-target="#supervisor{{$branch->cleanManager[$i]->supervisor[$y]->id}}">عرض</a><br>
                                    </th>
                                    <th> 
                                        <center>
                                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        التحكم
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                        <a class="btn btn-dark col-sm-12"  href="{{route('generalManagerSupervisors.show',['generalManagerSupervisor'=>$branch->cleanManager[$i]->supervisor[$y]->id])}}">عرض</a><br>
                                                        <a class="btn btn-dark col-sm-12"  href="{{route('generalManagerSupervisors.edit',['generalManagerSupervisor'=>$branch->cleanManager[$i]->supervisor[$y]->id])}}">تعديل</a>
                                                        <form method="post" action="{{route('generalManagerSupervisors.destroy',['generalManagerSupervisor'=>$branch->cleanManager[$i]->supervisor[$y]->id])}}">
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
                            @endfor
                            @endfor
                        @endforeach

                        
                    </tbody>
                </table>
                @foreach($branches as $branchh)
                    @for($i=0; $i < count($branchh->cleanManager); $i++)
                        @for($y = 0; $y < count($branchh->cleanManager[$i]->supervisor); $y++)
                        @if(count($branchh->cleanManager[$i]->supervisor[$y]->employee) == 0)
                        <div class="modal fade" id="supervisor{{$branchh->cleanManager[$i]->supervisor[$y]->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="supervisorLabel1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header backgroundColor text-white" style="border:none">
                                        <h5 class="modal-title" style="color: black" id="supervisorLabel1">الموظفين</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body backgroundColorSec p-5">
                                        لا يوجد موظفين
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                        @else
                        @for($z = 0; $z < count($branchh->cleanManager[$i]->supervisor[$y]->employee); $z++)
                            
                        <div class="modal fade" id="supervisor{{$branchh->cleanManager[$i]->supervisor[$y]->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="supervisorLabel1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header backgroundColor text-white" style="border:none">
                                        <h5 class="modal-title" style="color: black" id="supervisorLabel1">الموظفين</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body backgroundColorSec p-5">
                                        <table class="table">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">الاسم</th>
                                                <th scope="col">رقم الهاتف</th>
                                                <th scope="col">نوع التوظيف</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{{$branch->cleanManager[$i]->supervisor[$y]->employee[$z]->name}}</td>
                                                <td>{{$branch->cleanManager[$i]->supervisor[$y]->employee[$z]->phone}}</td>
                                                @if($branch->cleanManager[$i]->supervisor[$y]->employee[$z]->type == '0')
                                                    <td>عامل صيانة</td>
                                                @else
                                                    <td>عامل نظافة</td>
                                                @endif
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                        @endfor
                        @endif
                        @endfor
                    @endfor
                @endforeach
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