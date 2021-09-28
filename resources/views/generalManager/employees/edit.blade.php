@extends("layouts.generalManager")
@section("pageTitle", "Instructors")
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
                <h5 class="mb-5 mt-3">تعديل العامل </h5>

                <form method="post" action="{{route('generalManagerEmployees.update',['generalManagerEmployee'=>$employee->id])}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">الاسم</label>
                        <div class="col-sm-10">
                            <input class="form-control" value="{{$employee->name}}" name="name" type="text" id="example-text-input">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">البريد الالكتروني</label>
                        <div class="col-sm-10">
                            <input class="form-control" value="{{$employee->email}}" name="email" type="text" id="example-text-input">
                            @error('email')
                                <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">كلمة المرور</label>
                        <div class="col-sm-10">
                            <input class="form-control" value="{{$employee->real_password}}" name="password" type="text" id="example-text-input">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">رقم الهاتف</label>
                        <div class="col-sm-10">
                            <input class="form-control" value="{{$employee->phone}}" name="phone" type="text" id="example-text-input">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">رقم الهوية </label>
                        <div class="col-sm-10">
                            <input class="form-control" value="{{$employee->id_num}}" name="id_num" type="text" id="example-text-input">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">الرقم الوظيفي </label>
                        <div class="col-sm-10">
                            <input class="form-control" value="{{$employee->job_num}}" name="job_num" type="text" id="example-text-input">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">تاريخ الميلاد</label>
                        <div class="col-sm-10">
                            <input class="form-control" value="{{$employee->date}}" name="area" type="text" id="example-text-input">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">نوع العمل</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="type">
                            @if($employee->type == '0')
                                <option value="0" selected>عامل صيانة</option>
                                <option value="1">عامل نظافة</option>
                            @else
                                <option value="0">عامل صيانة</option>
                                <option value="1" selected>عامل نظافة</option>
                            @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">المشرف</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="supervisor_id">
                                @foreach($branches as $branch)
                                    @for($i=0; $i < count($branch->cleanManager); $i++)
                                        @for($y=0; $y < count($branch->cleanManager[$i]->supervisor); $y++)
                                            @if($branch->cleanManager[$i]->supervisor[$y]->id == $employee->supervisor_id)
                                                <option value="{{$branch->cleanManager[$i]->supervisor[$y]->id}}" selected>{{$branch->cleanManager[$i]->supervisor[$y]->name}}</option>
                                            @else
                                                <option value="{{$branch->cleanManager[$i]->supervisor[$y]->id}}">{{$branch->cleanManager[$i]->supervisor[$y]->name}}</option>
                                            @endif
                                        @endfor
                                    @endfor
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-dark w-25">تعديل</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
    
@endsection