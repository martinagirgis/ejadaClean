@extends("layouts.cleanMaintananceManager")
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
                <h5 class="mb-5 mt-3">تعديل الفريق </h5>

                <form method="post" action="{{route('teams.update',['team'=>1])}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">اسم الفريق</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="example-text-input" value="اختبار" name="Title_ar">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">المسؤول عن الفريق</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="example-text-input" value="تيست" name="Title_en">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">رقم هاتف المسؤول عن الفريق</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="example-text-input" value="0122222222" name="Title_ku">
                        </div>
                    </div>
                    <p>
                        اعضاء الفريق
                    </p>

                    <div class="row">
                        <div class='form-group col-5'>
                            <label for="example-text-input" class="col-sm-12 col-form-label">الاسم</label>
                            <div class="col-sm-12">
                                <input class="form-control"  type="text" id="example-text-input" value="اختبار عضو 1" name="Title_en">
                            </div>
                        </div>
        
                        <div class="form-group col-5">
                            <label for="example-text-input" class="col-sm-12 col-form-label">رقم الهاتف</label>
                            <div class="col-sm-12">
                                <input class="form-control" type="text" id="example-text-input" value="00000000" name="Title_ku">
                            </div>
                        </div>

                        <div class="form-group col-2">
                            <a class="btn btn-dark col-sm-12">حذف</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class='form-group col-5'>
                            <label for="example-text-input" class="col-sm-12 col-form-label">الاسم</label>
                            <div class="col-sm-12">
                                <input class="form-control" type="text" id="example-text-input" value="اختبار عضو 2" name="Title_en">
                            </div>
                        </div>
        
                        <div class="form-group col-5">
                            <label for="example-text-input" class="col-sm-12 col-form-label">رقم الهاتف</label>
                            <div class="col-sm-12">
                                <input class="form-control" type="text" id="example-text-input" value="0111111111" name="Title_ku">
                            </div>
                        </div>

                        <div class="form-group col-2">
                            <a class="btn btn-dark col-sm-12">حذف</a>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">اضافة اعضاء الفريق</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" onfocusout="loadMember()" id="memberNum" name="Title_ku">
                        </div>
                    </div>

                    <div id="members">

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


<script>
    function loadMember(){
        var memberNum = document.getElementById("memberNum").value ;
        var members = document.getElementById("members");
        var x = "";
        for (let index = 0; index < memberNum; index++) {
            x += `
            <div class="row">
                <div class='form-group col-6'>
                    <label for="example-text-input" class="col-sm-2 col-form-label">الاسم</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" id="example-text-input" name="Title_en">
                    </div>
                </div>

                <div class="form-group col-6">
                    <label for="example-text-input" class="col-sm-2 col-form-label">رقم الهاتف</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" id="example-text-input" name="Title_ku">
                    </div>
                </div>
            </div>`;
            
        }
        members.innerHTML = x ;
    }
</script>