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
                <h5 class="mb-5 mt-3">تعديل المرفق </h5>

                <form method="post" action="{{route('generalManagerFacilities.update',['generalManagerFacility'=>1])}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">الاسم</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="example-text-input" value="اختبار" name="Title_ar">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">المحطة</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="city_id">
                                    <option value="maintance">المحطة الاولى</option>
                                    <option value="clean">المحطة الثانية</option>
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <h3>
                        النظافة الدورية
                    </h3>

                    <div class="row">
                        <div class='form-group col-10'>
                            <label for="example-text-input" class="col-sm-12 col-form-label">اليوم</label>
                            <div class="col-sm-5">
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

                        <div class="form-group col-2">
                            <a class="btn btn-dark col-sm-12">حذف</a>
                        </div>
                    </div>

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
                    <br>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">اضافة مواعيد للنظافة الدورية</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" onfocusout="addCleanTimes()" id="cleanTimesNum" name="Title_ku">
                        </div>
                    </div>

                    <div id="cleanTimes">

                    </div>
                    <br><br><br><br>

                    <h3>
                        الصيانة الدورية
                    </h3>

                    <div class="row">
                        <div class='form-group col-10'>
                            <label for="example-text-input" class="col-sm-12 col-form-label">اليوم</label>
                            <div class="col-sm-5">
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

                        <div class="form-group col-2">
                            <a class="btn btn-dark col-sm-12">حذف</a>
                        </div>
                    </div>

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
                    <br>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">اضافة مواعيد للصيانة الدورية</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" onfocusout="addMaintananceTimes()" id="maintananceTimesNum" name="Title_ku">
                        </div>
                    </div>

                    <div id="maintananceTimes">

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
    function addCleanTimes(){
        var cleanTimesNum = document.getElementById("cleanTimesNum").value ;
        var cleanTimes = document.getElementById("cleanTimes");
        var x = "";
        for (let index = 0; index < cleanTimesNum; index++) {
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
            </div>`;
            
        }
        cleanTimes.innerHTML = x ;
    }

    function addMaintananceTimes(){
        var maintananceTimesNum = document.getElementById("maintananceTimesNum").value ;
        var maintananceTimes = document.getElementById("maintananceTimes");
        var x = "";
        for (let index = 0; index < maintananceTimesNum; index++) {
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
            </div>`;
            
        }
        maintananceTimes.innerHTML = x ;
    }
</script>