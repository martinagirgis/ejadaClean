@extends("layouts.generalManager")
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
                        <th>المشرف التابع له</th>
                        {{-- <th>المهام</th> --}}
                        <th>التحكم</th>
                    </tr> 
                    </thead>

                    <tbody>
                        @foreach($branches as $branch)
                            @for($i=0; $i < count($branch->cleanManager); $i++)
                                @for($y = 0; $y < count($branch->cleanManager[$i]->supervisor); $y++)
                                    @for($z = 0; $z < count($branch->cleanManager[$i]->supervisor[$y]->employee); $z++)
                                        <tr>
                                            <th>{{$branch->cleanManager[$i]->supervisor[$y]->employee[$z]->name}}</th>
                                            <th>{{$branch->cleanManager[$i]->supervisor[$y]->employee[$z]->email}}</th>
                                            <th>{{$branch->cleanManager[$i]->supervisor[$y]->employee[$z]->phone}}</th>
                                            @if($branch->cleanManager[$i]->supervisor[$y]->employee[$z]->type == '0')
                                                <th>عامل صيانة</th>
                                            @elseif($branch->cleanManager[$i]->supervisor[$y]->employee[$z]->type == '1')
                                                <th>عامل نظافة</th>
                                            @endif
                                            <th>{{$branch->cleanManager[$i]->supervisor[$y]->name}}</th>
                                            {{-- <th>
                                                <a class="btn btn-dark col-sm-12"  href="{{route('generalManagerEmployees.tasks',['id'=>$branch->cleanManager[$i]->supervisor[$y]->employee[$z]->id])}}">عرض</a>
                                            </th> --}}
                                            <th> 
                                                <center>
                                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        
                                                        <div class="btn-group" role="group">
                                                            <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                التحكم
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                                <a class="btn btn-dark col-sm-12"  href="{{route('generalManagerEmployees.show',['generalManagerEmployee'=>$branch->cleanManager[$i]->supervisor[$y]->employee[$z]->id])}}">عرض</a><br>
                                                                <a class="btn btn-dark col-sm-12"  href="{{route('generalManagerEmployees.edit',['generalManagerEmployee'=>$branch->cleanManager[$i]->supervisor[$y]->employee[$z]->id])}}">تعديل</a>
                                                                <form method="post" action="{{route('generalManagerEmployees.destroy',['generalManagerEmployee'=>$branch->cleanManager[$i]->supervisor[$y]->employee[$z]->id])}}">
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
                            @endfor
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