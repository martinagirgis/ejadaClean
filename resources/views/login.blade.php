<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>@yield("title", "Clean")</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset("assets/admin/images/icon.png")}}">

    <link href="{{asset('assets/admin/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{asset("assets/admin/css/bootstrap.min.css")}}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{asset("assets/admin/css/icons.min.css")}}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    @yield("style")
    <link href="{{asset("assets/admin/css/app-rtl.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/admin/css/redo.css")}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/site/css/teacher.css')}}">

<style>
        .field-icon {
            float: right;
            margin-top: -50px;
            position: relative;
            z-index: 2;
        }
        .field-icon1 {
            float: right;
            margin-top: -27px;
            position: relative;
            z-index: 2;
        }
        .field-icon_ar {
            float: left;
            margin-top: -50px;
            position: relative;
            z-index: 2;
        }
        .field-icon1_ar {
            float: left;
            margin-top: -27px;
            position: relative;
            z-index: 2;
        }


    </style>
</head>
<body>

    <!-- Loader -->
    <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

     <!-- Begin page -->
     <div class="accountbg" style="background: url('{{asset("assets/admin/images/bg.jpg")}}');background-size: cover;background-position: center;"></div>

    <div class="account-pages mt-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">
                        <div class="card-body">
                            @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>    
                                <strong>{{ $message }}</strong>
                            </div>
                            @endif
                            <div class="text-center mt-4">
                                <div class="">
                                    <a href="index.html"><img src="{{asset("assets/admin/images/logonew.png")}}" height="50" alt="logo"></a>
                                </div>
                            </div>
                            <div class="p-3 pt-0">
                                <h4 class="font-size-18 mt-2 text-center">تسجيل دخول</h4>

                                <form class="form-horizontal" method="post"  action="{{route('check.auth.login')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="type">النوع</label>
                                        <select class="form-control" id="type" name="type">
                                            <option value="employee">عامل</option>
                                            <option value="supervisor">مشرف</option>
                                            <option value="clean_mantanance_manager">مدير الصيانة و النظافة</option>
                                            <option value="quality_manager">مدير الجودة</option>
                                            <option value="company_general_manager">مدير عام</option>
                                            <option value="admin">مسؤول</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">البريد الالكتروني</label>
                                        <input type="mail" class="form-control" name="email" id="email" placeholder="ادخل البريد الالكتروني" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="userpassword">كلمة المرور</label>
                                        
                                        <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="ادخل كلمة المرور" required>
                                        <span toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon1_ar toggle-password"></span>
                                    </div>

                                    <div class="form-group row m-auto">
                                        <div class="col-sm-12 text-center">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">تسجيل دخول</button>
                                        </div>
                                    </div>

                                </form>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{asset("assets/admin/libs/jquery/jquery.min.js")}}"></script>
    <script src="{{asset("assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{asset("assets/admin/libs/metismenu/metisMenu.min.js")}}"></script>
    <script src="{{asset("assets/admin/libs/simplebar/simplebar.min.js")}}"></script>
    <script src="{{asset("assets/admin/libs/node-waves/waves.min.js")}}"></script>
    <script src="{{asset("assets/admin/js/app.js")}}"></script>
<script>
    $(".toggle-password").click(function() {

           $(this).toggleClass("fa-eye fa-eye-slash");
           var input = $("#inputPassword4");
           if (input.attr("type") == "password") {
               input.attr("type", "text");
           } else {
               input.attr("type", "password");
           }
       });
</script>
</body>
</html>
