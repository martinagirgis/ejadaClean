@extends("layouts.generalManager")
@section("pageTitle", "المشرفين")
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
                <h5 class="mb-5 mt-3">اضافة فريق جديد</h5>

                <form method="post" action="{{route('generalManagerTeams.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">اسم الفريق</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="example-text-input" name="Title_ar">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> مدير الصيانة و النظافة التابع له</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="city_id">
                                    <option value="maintance">الاسم الاول</option>
                                    <option value="clean">الاسم الثاني</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">المسؤول عن الفريق</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="example-text-input" name="Title_en">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">رقم هاتف المسؤول عن الفريق</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="example-text-input" name="Title_ku">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">عدد اعضاء الفريق</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" onfocusout="loadMember()" id="memberNum" name="Title_ku">
                        </div>
                    </div>

                    <div id="members">

                    </div>

                    <div class="form-group row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-dark w-25">اضافة</button>
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