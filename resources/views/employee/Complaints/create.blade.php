@extends("layouts.employee")
@section("pageTitle", "المشرفين")
@section('style')

    <style>
        .progress { position:relative; width:100%; }
        .bar { background-color: #00ff00; width:0%; height:20px; }
        .percent { position:absolute; display:inline-block; left:50%; color: #040608;}
    </style>
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
                    <h5 class="mb-5 mt-3">اضافة شكوى جديد</h5>
                    <div class="wrapper">
                        <form method="POST" action="{{route('complaints.store')}}" enctype="multipart/form-data" id="myform">
                            @csrf
                            {{-- <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">عنوان الشكوى</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="example-text-input" name="title">
                                </div>
                            </div> --}}

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">النوع</label>
                                <div class="col-sm-10">
                                    <select class="form-control facility_id" name="type" id="type">
                                        <option value="0"> صيانة</option>
                                        <option value="1"> نظافة</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">المرفق</label>
                                <div class="col-sm-10">
                                    <select class="form-control facility_id" id="facility_id" name="facility_id">
                                            <option>اختر المرفق</option>
                                        @foreach($facilities as $fcility)
                                            <option  value="{{$fcility->id}}">{{$fcility->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">عنوان الشكوى</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="title" id="title" required>
                                        
                                    </select>
                                </div>
                            </div>

                            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">التفاصيل</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" id="example-text-input" name="description"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <input name="file" type="file" accept="image/,video/" class="form-control"><br/>
                                <div class="progress" style="height:fit-content">
                                    <div class="bar"></div >
                                    <div class="percent">0%</div >
                                </div>
                                <br>
                                <input type="submit"  value="ارسال" class="btn btn-primary">
                            </div>
                        </form>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

        <script
        src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
        crossorigin="anonymous">
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
        <script>
        $(document).ready(function(){
           $('.facility_id').on('change', function() {
               var id = $('#facility_id').val();
               var type = $('#type').val();
               console.log(type);
               $.ajax({
               url:'http://127.0.0.1:8000/complaintslist/complaintsLists',
                   method:"get",
                   data:{facility_id:id, type:type},
                   dataType:"json",
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   success:function(data){ 
                    var title = document.getElementById('title');
                    title.innerHTML = "";
                    data.forEach(district => title.innerHTML += "<option value="+district.id+">"+district.name+"</option>");
                    //    alert(data);
                   }
               });
        
           });
        });
        </script>
@endsection
@section('script')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>

    <script>
        var SITEURL = "{{route('complaints.store')}}";
        $(function() {
            $(document).ready(function()
            {
                var bar = $('.bar');
                var percent = $('.percent');
                $('#myform').ajaxForm({
                    beforeSend: function() {

                        var percentVal = '0%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentVal = percentComplete + '%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                    },
                    complete: function(xhr) {
                        alert('File Has Been Uploaded Successfully');
                        window.location.href = "{{route('complaints.store')}}";
                    }
                });
            });
        });


    </script>


@endsection