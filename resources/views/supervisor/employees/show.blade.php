@extends("layouts.supervisor")
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
                <h5 class="mb-5 mt-3">عرض العامل </h5>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">الاسم</label>
                        <div class="col-sm-10">
                            {{$employee->name}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">البريد الالكتروني</label>
                        <div class="col-sm-10">
                            {{$employee->email}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">كلمة المرور</label>
                        <div class="col-sm-10">
                            {{$employee->real_password}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">رقم الهاتف</label>
                        <div class="col-sm-10">
                            {{$employee->phone}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">رقم الهوية </label>
                        <div class="col-sm-10">
                            {{$employee->id_num}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">الرقم الوظيفي </label>
                        <div class="col-sm-10">
                            {{$employee->job_num}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">تاريخ الميلاد </label>
                        <div class="col-sm-10">
                            {{$employee->date}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">نوع العمل</label>
                        <div class="col-sm-10">
                            @if($employee->type == '0')
                                عامل صيانة
                            @else
                                عامل نظافة
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">المشرف </label>
                        <div class="col-sm-10">
                            {{$employee->supervisor->name}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">المهمات </label>
                        <div class="col-sm-10">
                            <a class="btn btn-dark col-sm-12"  href="{{route('supervisorEmployees.tasks',['id'=>$employee->id])}}">عرض</a>
                        </div>
                    </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection
