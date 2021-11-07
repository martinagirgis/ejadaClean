@extends("layouts.supervisor")
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
                    <h5 class="mb-5 mt-3">تسليم المهمة {{$task->title}}</h5>
                    <div class="wrapper">
                        <form method="POST" action="{{route('supervisor.task.StoreCompany')}}" enctype="multipart/form-data" id="myform">
                            @csrf
               
                            <input value="{{$task->id}}" name="id" type="hidden">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">الملاحظات</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" id="example-text-input" name="note"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <input name="file" type="file" accept="image/,video/" class="form-control"><br/>
                                <div class="progress">
                                    <div class="bar"></div >
                                    <div class="percent">0%</div >
                                </div>
                                <br>
                                <input type="submit"  value="Submit" class="btn btn-primary">
                            </div>
                        </form>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


@endsection
@section('script')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>

            <script>
        var SITEURL = "{{route('tasksSendStore')}}";
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
                        window.location.href = "{{route('supervisor.task.WaitingCompany')}}";
                    }
                });
            });
        });


    </script>
@endsection