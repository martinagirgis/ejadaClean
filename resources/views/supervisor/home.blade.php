@extends("layouts.supervisor")
@section("pageTitle", "Koala Web Libraries")
@section('styleChart')
<link href="{{asset("assets/admin/libs/c3/c3.min.css")}}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
@endsection
@section("content")
<div class="row ">
    <div class="col-md-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="mini-stat">
                    <span class="mini-stat-icon bg-primary float-left"><i class="fas fa-code-branch"></i></span>
                    <div class="mini-stat-info text-right">
                        <span class="counter text-primary">{{$employeeNum}}</span>
                        عدد العمال
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="mini-stat clearfix">
                    <span class="mini-stat-icon bg-success float-left"><i class="fa fa-user"></i></span>
                    <div class="mini-stat-info text-right">
                        <span class="counter text-success">200</span>
                        عدد الشكاوي
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="col-md-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="mini-stat clearfix">
                    <span class="mini-stat-icon bg-warning float-left"><i class="fas fa-user"></i></span>
                    <div class="mini-stat-info text-right">
                        <span class="counter text-warning">30</span>
                        عدد المهام
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div> --}}

</div>

@endsection

@section("script")
<script src="{{asset("assets/admin/libs/d3/d3.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/c3/c3.min.js")}}"></script>

@endsection
