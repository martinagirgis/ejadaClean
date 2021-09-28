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
                <h5 class="mb-5 mt-3">تعديل الفريق </h5>

                <form method="post" action="{{route('teams.update',['team'=>$team->id])}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">اسم الفريق</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="example-text-input" value="{{$team->name}}" name="name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">المسؤول عن الفريق</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="example-text-input" value="{{$team->leader_name}}" name="leader_name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">رقم هاتف المسؤول عن الفريق</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="example-text-input" value="{{$team->leader_phone}}" name="leader_phone">
                        </div>
                    </div>
                    <p>
                        اعضاء الفريق
                    </p>
                    @foreach($team->members as $member)
                        
                    <div class="row">
                        <div class='form-group col-5'>
                            <label for="example-text-input" class="col-sm-12 col-form-label">الاسم</label>
                            <div class="col-sm-12">
                                <input class="form-control"  type="text" id="example-text-input" value="{{$member->name}}" name="name{{$member->id}}">
                            </div>
                        </div>
        
                        <div class="form-group col-5">
                            <label for="example-text-input" class="col-sm-12 col-form-label">رقم الهاتف</label>
                            <div class="col-sm-12">
                                <input class="form-control" type="text" id="example-text-input" value="{{$member->phone}}" name="phone{{$member->id}}">
                            </div>
                        </div>

                        <div class="form-group col-2">
                            <a href="{{route('teamMember.delete',['id'=>$member->id])}}" class="btn btn-dark col-sm-12" >حذف</a>
                        </div>

                    </div>

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
