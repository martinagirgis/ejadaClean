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
                <h5 class="mb-5 mt-3">اضافة مرفق جديدة</h5>

                <form method="post" action="{{route('facilities.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">اسم المرفق</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="example-text-input" name="name">
                        </div>
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