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
                <h5 class="mb-5 mt-3">تعديل المرفق </h5>

                <form method="post" action="{{route('facilities.update',['facility'=>$facility->id])}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">الاسم</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="example-text-input" value="{{$facility->name}}" name="name">
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>

                    <h3>
                        النظافة الدورية
                    </h3>

                    @foreach($facility->times as $time)
                        @if($time->type == "clean")

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="example-text-input" class="col-sm-12 col-form-label">العنوان</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="example-text-input" name="title|{{$time->id}}" value="{{$time->title}}" required>
                            </div>
                        </div>
        
                        <div class="form-group col-6">
                            <label for="example-text-input" class="col-sm-12 col-form-label">التفاصيل</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="example-text-input" name="description|{{$time->id}}" required>{{$time->description}}</textarea>
                            </div>
                        </div>

                        <div class='form-group col-3'>
                            <label for="example-text-input" class="col-sm-12 col-form-label">اليوم</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="day|{{$time->id}}">
                                    <option selected value="{{$time->day}}">{{$time->day}}</option>
                                    <option value="Sat">سبت</option>
                                    <option value="Sun">أحد</option>
                                    <option value="Mon">أثنين</option>
                                    <option value="Tue">ثلاثاء</option>
                                    <option value="Wed">أربعاء</option>
                                    <option value="Thu">خميس</option>
                                    <option value="Fri">جمعة</option>
                                </select>
                            </div>
                        </div>
        
                        <div class="form-group col-2">
                            <label for="example-text-input" class="col-sm-12 col-form-label">الوقت</label>
                            <div class="col-sm-12">
                                <input class="form-control" type="time" id="example-text-input" value="{{$time->time}}" name="time|{{$time->id}}">
                            </div>
                        </div>

                        <div class="form-group col-2">
                            <label for="example-text-input" class="col-sm-12 col-form-label">المدة</label>
                            <div class="col-sm-12">
                                <input class="form-control" type="number" id="example-text-input" value="{{$time->period}}" name="period|{{$time->id}}">
                            </div>
                        </div>

                        <div class="form-group col-3">
                            <label for="example-text-input" class="col-sm-12 col-form-label">العامل</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="employee_id|{{$time->id}}" required>
                                    @foreach($supervisors as $supervisor)
                                        @for($i=0; $i < count($supervisor->employee); $i++)
                                            @if($supervisor->employee[$i]->type == '1')
                                            @if($supervisor->employee[$i]->id == $time->employee_id)
                                            <option value="{{$supervisor->employee[$i]->id}}" selected>{{$supervisor->employee[$i]->name}}</option>
                                            @else
                                            <option value="{{$supervisor->employee[$i]->id}}">{{$supervisor->employee[$i]->name}}</option>
                                            @endif
                                            @endif
                                        @endfor
                                    @endforeach
                                    </select>
                                </div>
                        </div>
                        
                        <div class="form-group col-2">
                            <a href="{{route('facilities.times.delete',['time'=>$time->id])}}" class="btn btn-dark col-sm-12" >حذف</a>
                        </div>

                    </div>
                    @endif
                    @endforeach

                    <br>
                    <hr>
                    <br>
                    <h3>
                        الصيانة الدورية
                    </h3>

                    @foreach($facility->times as $timee)
                        @if($timee->type == "maintatance")

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">العنوان</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" id="example-text-input" name="title|{{$timee->id}}" value="{{$timee->title}}" required>
                                    </div>
                                </div>
                
                                <div class="form-group col-6">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">التفاصيل</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="example-text-input" name="description|{{$timee->id}}" required>{{$timee->description}}</textarea>
                                    </div>
                                </div>

                                <div class='form-group col-3'>
                                    <label for="example-text-input" class="col-sm-12 col-form-label">اليوم</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="day|{{$timee->id}}">
                                            <option selected value="{{$timee->day}}">{{$timee->day}}</option>
                                            <option value="Sat">سبت</option>
                                            <option value="Sun">أحد</option>
                                            <option value="Mon">أثنين</option>
                                            <option value="Tue">ثلاثاء</option>
                                            <option value="Wed">أربعاء</option>
                                            <option value="Thu">خميس</option>
                                            <option value="Fri">جمعة</option>
                                        </select>
                                    </div>
                                </div>
                
                                <div class="form-group col-2">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">الوقت</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="time" id="example-text-input" value="{{$timee->time}}" name="time|{{$timee->id}}">
                                    </div>
                                </div>

                                <div class="form-group col-2">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">المدة</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="number" id="example-text-input" value="{{$timee->period}}" name="period|{{$timee->id}}">
                                    </div>
                                </div>

                                <div class="form-group col-3">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">العامل</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="employee_id|{{$timee->id}}" required>
                                            @foreach($supervisors as $supervisorr)
                                                @for($i=0; $i < count($supervisorr->employee); $i++)
                                                    @if($supervisorr->employee[$i]->type == '0')
                                                    @if($supervisorr->employee[$i]->id == $timee->employee_id)
                                                    <option value="{{$supervisorr->employee[$i]->id}}" selected>{{$supervisorr->employee[$i]->name}}</option>
                                                    @else
                                                    <option value="{{$supervisorr->employee[$i]->id}}">{{$supervisorr->employee[$i]->name}}</option>
                                                    @endif
                                                    @endif
                                                @endfor
                                            @endforeach
                                            </select>
                                        </div>
                                </div>
                                
                                <div class="form-group col-2">
                                    <a href="{{route('facilities.times.delete',['time'=>$timee->id])}}" class="btn btn-dark col-sm-12" >حذف</a>
                                </div>

                            </div>
                        @endif
                    @endforeach

                    
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