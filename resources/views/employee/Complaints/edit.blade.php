@extends("layouts.employee")
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
                    <h5 class="mb-5 mt-3">اضافة شكوى جديد</h5>

                    <form method="post" action="{{route('complaints.update',['complaint'=>1])}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">عنوان الشكوى</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" value="اختبار اختار" id="example-text-input" name="Title_ar">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">التفاصيل</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="3" id="example-text-input" name="Title_en">تفاااااااااصيل</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">ارفاق ملف</label>
                            <div class="custom-file col-sm-10">
                                <input name="image" type="file" class="custom-file-input" id="customFileLangHTML" required>
                                <label class="custom-file-label" for="customFileLangHTML" data-browse="ارفاق ملف"></label>
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
