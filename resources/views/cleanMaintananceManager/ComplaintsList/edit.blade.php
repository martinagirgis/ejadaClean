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
                <h5 class="mb-5 mt-3">تعديل عنوان الشكوى </h5>

                <form method="post" action="{{route('complaintsLists.update',['complaintsList'=>$complaintsList->id])}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">الاسم</label>
                        <div class="col-sm-10">
                            <input class="form-control" value="{{$complaintsList->name}}" name="name" type="text" id="example-text-input">
                        </div>
                    </div>

                    
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">اسم المرفق</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="facility_id">
                                @foreach($fcilities as $fcility)
                                @if ($complaintsList->facility_id == $fcility->id)
                                    <option value="{{$fcility->id}}" selected>{{$fcility->name}}</option>
                                @else
                                    <option value="{{$fcility->id}}">{{$fcility->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">نوع الشكوى</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="facility_id">
                                @if ($complaintsList->type == 'صيانة')
                                <option selected value="صيانة"> صيانة</option>
                                <option value="نظافة"> نظافة</option>
                                @else
                                <option value="صيانة"> صيانة</option>
                                <option selected value="نظافة"> نظافة</option>
                                @endif
                            </select>
                        </div>
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