@extends("layouts.cleanMaintananceManager")
@section('style')

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
                    <h5 class="mb-5 mt-3">عمل مهمة </h5>
                    <div class="wrapper">
                        <form method="POST" action="{{route('managerClean.StoreTask')}}" enctype="multipart/form-data" id="myform">
                            @csrf
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">عنوان المهمه</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="example-text-input" name="title" value="{{$task->title}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">التفاصيل</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" id="example-text-input" name="description" required>{{$task->description}} </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">النوع</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="emptype" name="type">
                                        @if($task->type == '0')
                                        <option value="{{$task->type}}" selected> صيانة</option>
                                        @elseif($task->type == '1')
                                        <option value="{{$task->type}}" selected> نظافة</option>
                                        @endif
                                        <option value="0"> صيانة</option>
                                        <option value="1"> نظافة</option>
                                    </select>
                                </div>
                            </div>

                            <div class='form-group row'>
                                <label for="example-text-input" class="col-sm-2 col-form-label">التاريخ </label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="date" id="example-text-input" name="date" value="{{$task->date}}" required>
                                </div>
                            </div>

                            <div class='form-group row'>
                                <label for="example-text-input" class="col-sm-2 col-form-label">الوقت  </label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="time" id="example-text-input" name="time" value="{{$task->time}}" required>
                                </div>
                            </div>
            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">مدة العمل</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="number" id="example-text-input" name="period" value="{{$task->period}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">نوع الدعم</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="support_type" id="support_type">
                                        @if($task->support_type == '0')
                                        <option value="{{$task->support_type}}" selected> العمال</option>
                                        @elseif($task->support_type == '1')
                                        <option value="{{$task->support_type}}" selected> فريق</option>
                                        @elseif($task->support_type == '2')
                                        <option value="{{$task->support_type}}" selected> شركة راعية</option>
                                        @endif
                                        <option>اخنر نوع الدعم</option>
                                        <option value="0"> العمال</option>
                                        <option value="1"> فريق خاص</option>
                                        <option value="2"> شركة راعية</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" id="typeWord"></label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="emp" name="support_id" required>
                                        @if($task->support_type == '0')
                                        <option value="{{$task->employee->id}}" selected> {{$task->employee->name}}</option>
                                        @elseif($task->support_type == '1')
                                        <option value="{{$task->team->id}}" selected> {{$task->team->name}}</option>
                                        @elseif($task->support_type == '2')
                                        <option value="{{$task->company->id}}" selected> {{$task->company->name}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
            
                            <div class="form-group row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-dark w-25">حفظ</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


@endsection
<script
        src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
        crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){
           $('#support_type').on('change', function() {
               var id = $(this).val();
               var emptype = $('#emptype').val();
               console.log(emptype);
               $.ajax({
               url:'https://fixit4maint.com/getTypeMempers',
                   method:"get",
                   data:{type:id},
                   dataType:"json",
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   success:function(data){ 
                    var emps = document.getElementById('emp');
                    emps.innerHTML = "";
                    if(id == '0')
                    {
                        document.getElementById('typeWord').textContent = 'العامل';
                        for (let i = 0; i < data.length; i++) {
                            for (let y = 0; y < data[i]['employee'].length; y++) {
                                if(data[i]['employee'][y].type == emptype)
                                {
                                    emps.innerHTML += "<option value="+data[i]['employee'][y].id+">"+data[i]['employee'][y].name+"</option>"
                                }
                            }
                            // data[i]['employee'].forEach(district => emps.innerHTML += "<option value="+district.id+">"+district.name+"</option>");
                        }
                    }
                    if(id == '1')
                    {
                        document.getElementById('typeWord').textContent = 'الفريق الخاص';
                        data.forEach(district => emps.innerHTML += "<option value="+district.id+">"+district.name+"</option>");
                    }
                    if(id == '2')
                    {
                        document.getElementById('typeWord').textContent = 'الشركة الراعية';
                        data.forEach(district => emps.innerHTML += "<option value="+district.id+">"+district.name+"</option>");
                    }
                    // var districts = document.getElementById('district_id');
                    
                    // districts.innerHTML = "";
                    
                    // data.forEach(district => districts.innerHTML += "<option value="+district.id+">"+district.Title_ar+"</option>");
                    
                    //console.log(typeof data);

                   console.log(data);
                //    alert(data);
                   }
               });
   
           });
              $('#emptype').on('change', function() {
                var emps = document.getElementById('emp');
                emps.innerHTML = "";
                var emps = document.getElementById('support_type');
                emps.innerHTML = `<option>اخنر نوع الدعم</option>
                                        <option value="0"> العمال</option>
                                        <option value="1"> فريق خاص</option>
                                        <option value="2"> شركة راعية</option>`;
                   
               });
       });
   </script>
