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
                <h5 class="mb-5 mt-3">تعديل المحطة </h5>

                <form method="post" action="{{route('branches.update',['branch'=>$branch->id])}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">الاسم</label>
                        <div class="col-sm-10">
                            <input class="form-control" value="{{$branch->name}}" name="name" type="text" id="example-text-input">
                        </div>
                    </div>

                    {{-- <div class="form-group row">
                        <label class="col-sm-2 col-form-label">مدير الصيانة و النظافة</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="city_id">
                                    <option value="maintance">الاسم الاول</option>
                                    <option value="clean">الاسم الثاني</option>
                            </select>
                        </div>
                    </div> --}}

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