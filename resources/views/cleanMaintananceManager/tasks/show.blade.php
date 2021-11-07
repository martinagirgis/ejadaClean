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
                    <h5 class="mb-5 mt-3">عرض المهمة </h5>
                    <div class="wrapper">
                        
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">عنوان المهمه</label>
                                <div class="col-sm-10">
                                    {{$task->title}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">التفاصيل</label>
                                <div class="col-sm-10">
                                    {{$task->description}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">النوع</label>
                                <div class="col-sm-10">
                                        @if($task->type == '0')
                                        صيانة
                                        @elseif($task->type == '1')
                                        نظافة
                                        @endif
                                </div>
                            </div>

                            <div class='form-group row'>
                                <label for="example-text-input" class="col-sm-2 col-form-label">التاريخ </label>
                                <div class="col-sm-10">
                                    {{$task->date}}
                                </div>
                            </div>

                            <div class='form-group row'>
                                <label for="example-text-input" class="col-sm-2 col-form-label">الوقت  </label>
                                <div class="col-sm-10">
                                    {{$task->time}}
                                </div>
                            </div>
            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">مدة العمل</label>
                                <div class="col-sm-10">
                                    {{$task->period}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">نوع الدعم</label>
                                <div class="col-sm-10">
                                        @if($task->support_type == '0')
                                        العمال
                                        @elseif($task->support_type == '1')
                                         فريق خاص
                                        @elseif($task->support_type == '2')
                                         شركة راعية
                                         @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" id="typeWord"></label>
                                <div class="col-sm-10">
                                        @if($task->support_type == '0')
                                        {{$task->employee->name}}
                                        @elseif($task->support_type == '1')
                                        {{$task->team->name}}
                                        @elseif($task->support_type == '2')
                                        {{$task->company->name}}
                                        @endif
                                </div>
                            </div>
            
                            @if($task->attach !='')
                                <?php
                                    $mime = mime_content_type(public_path('assets/attach/'. $task->attach));
                                    if(strstr($mime, "video/")){
                                        $type = 'video';
                                    }else if(strstr($mime, "image/")){
                                        $type = 'image';
                                    }    
                                ?>
                                @if($type == 'image')
                                    <div class="group-img-container text-center post-modal">
                                        <img  src="{{asset('assets/attach/'. $task->attach)}}" alt="" class="group-img img-fluid " ><br>
                                    </div>
                                @elseif($type == 'video')
                                    <div class="group-img-container text-center post-modal">
                                        <video width="100%" height="340" controls>
                                            <source src="{{URL::asset('/assets/attach/'. $task->attach)}}" type="video/mp4">
                                        </video>
                                    </div>
                                @endif

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">الملاحظات</label>
                                    <div class="col-sm-10">
                                        {{$task->note}}
                                    </div>
                                </div>
                            @endif

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


@endsection

