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
                <h5 class="mb-5 mt-3">اضافة ميعاد الصيانة دورية جديد</h5>

                <form method="post" action="{{route('facilities.mantananceStoretimes',['facility'=>$facility])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">اليوم</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="day" required>
                                {{-- @foreach($cities as $city) --}}
                                    <option value="سبت">سبت</option>
                                    <option value="أحد">أحد</option>
                                    <option value="أثنين">أثنين</option>
                                    <option value="ثلاثاء">ثلاثاء</option>
                                    <option value="أربعاء">أربعاء</option>
                                    <option value="خميس">خميس</option>
                                    <option value="جمعة">جمعة</option>
                                {{-- @endforeach --}}
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">عدد مرات التكرار</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" onfocusout="loadMember()" id="memberNum" name="timesnum" required>
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
                        <input class="form-control" type="time" id="example-text-input" name="time`+index+`" required>
                    </div>
                </div>

                <div class="form-group col-4">
                    <label for="example-text-input" class="col-sm-12 col-form-label">مدة العمل</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" id="example-text-input" name="period`+index+`" required>
                    </div>
                </div>

                <div class="form-group col-4">
                    <label class="col-sm-12 col-form-label">اسم العامل</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="employee_id`+index+`" required>
                        @foreach($supervisors as $supervisor)
                            @for($i=0; $i < count($supervisor->employee); $i++)
                                @if($supervisor->employee[$i]->type == '0')
                                    <option value="{{$supervisor->employee[$i]->id}}">{{$supervisor->employee[$i]->name}}</option>
                                @endif
                            @endfor
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>
            `;
            
        }
        members.innerHTML = x ;
    }
</script>