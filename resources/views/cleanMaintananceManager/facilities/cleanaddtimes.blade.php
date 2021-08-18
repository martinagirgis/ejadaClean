@extends("layouts.cleanMaintananceManager")
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
                <h5 class="mb-5 mt-3">اضافة ميعاد نظافة دورية جديد</h5>

                <form method="post" action="{{route('teams.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">اليوم</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="city_id">
                                {{-- @foreach($cities as $city) --}}
                                    <option value="maintance">سبت</option>
                                    <option value="clean">أحد</option>
                                    <option value="maintance">اثنين</option>
                                    <option value="clean">ثلاثاء</option>
                                    <option value="maintance">أربعاء</option>
                                    <option value="clean">خميس</option>
                                    <option value="maintance">جمعة</option>
                                {{-- @endforeach --}}
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">عدد مرات التكرار</label>
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
                <div class='form-group col-4'>
                    <label for="example-text-input" class="col-sm-12 col-form-label">الوقت</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="time" id="example-text-input" name="Title_en">
                    </div>
                </div>

                <div class="form-group col-4">
                    <label for="example-text-input" class="col-sm-12 col-form-label">مدة العمل</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" id="example-text-input" name="Title_ku">
                    </div>
                </div>

                <div class="form-group col-4">
                    <label class="col-sm-12 col-form-label">اسم العامل</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="city_id">
                                <option value="maintance">العمل الاول</option>
                                <option value="clean">العامل الثاني</option>
                        </select>
                    </div>
                </div>
            </div>
            `;
            
        }
        members.innerHTML = x ;
    }
</script>