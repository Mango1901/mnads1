<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
</head>

<link href="{{"public/home/css/bootstrap.css"}}" rel="stylesheet">
<link href="{{"public/home/css/bootstrap.min.css"}}" rel="stylesheet">
<script src="{{"public/home/js/bootstrap.js"}}"></script>
<script src="{{"public/home/js/bootstrap.min.js"}}"></script>
<link href="{{"public/home/css/font-awesome.min.css"}}" rel="stylesheet">
<link href="{{"public/home/css/style.css"}}" rel="stylesheet">
<body>
<style>
    body {
        font-family: 'IBM Plex Sans', sans-serif;
    }
    a{
        color: black;
        text-decoration: none;
    }
    .btn-f{
        background-color: #004085;
    }
    @media (max-width: 990px) {
        .img_hide{
            display: none;
        }
        .col-lg-8{
            display: none;
        }
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col col-lg-4 col-md-12">
            <div style="width: 62%; margin: auto">
                <div class="text-center">
                    <a href="{{url("/")}}" class="mt-3">
                        <img src="http://bbq.dhi.mybluehost.me/congtyphuongdong.vn/wp-content/uploads/2019/10/logo-1024x324.png"
                             alt="logo" style="width: 200px">
                    </a>
                </div>
                <h4 class="font-weight-bold">{{trans('message.welcome')}}</h4>
                 <div style="font-size: 14px">{{trans('message.fill')}}</div>
                    @if (session('message'))
                      <div class="alert alert-success help-block">{{session('message')}}</div>
                    @endif
                    @if (session('error'))
                      <div class="alert alert-danger help-block">{{session('error')}}</div>
                    @endif
                <div class="mt-5 text-center">
                    <a href="{{ url('/login-facebook') }}" class="btn btn-f" style="color: white; padding: 15px"><i class="fa fa-facebook"></i> <span style="text-align: center;padding: 20px" >{{trans('message.fb')}}</span> </a>
                </div>
                <div class="mt-3 text-center">
                    <a href="{{ url('/login-google') }}" class="btn btn-outline-danger" style="padding: 15px"><i class="fa fa-google"></i> <span style="text-align: center; padding: 25px" >{{trans('message.gg')}}</span> </a>
                </div>

                <div class="text-center mt-3 mb-3">{{trans('message.or')}}</div>

                <div class="form-group">
                    <form class="user outer-repeater needs-validation" action="{{action('Admin\AdminController@create')}}" novalidate method="post">
                        @csrf
                       <div class="form-group">
                           <input type="text" placeholder="Username:" name="username" required maxlength="20" class="form-control form-control-user mb-3">
                           <div class="invalid-feedback">Nhập username: </div>
                       </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" placeholder="Email Address" required maxlength="50"  class="form-control form-control-user mb-3">
                            <div class="invalid-feedback">Nhập email: </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="fullname" id="fullname" placeholder="Fullname" required maxlength="40" class="form-control form-control-user mb-3">
                            <div class="invalid-feedback">Nhập Họ và tên: </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="website" id="website" placeholder="Website" required maxlength="45" class="form-control form-control-user mb-3">
                            <div class="invalid-feedback">Nhập website: </div>
                        </div>
                        <div class="form-group">
                             <input type="password" name="password" id="password" placeholder="Password" required minlength="8" class="form-control form-control-user mb-3">
                            <div class="invalid-feedback">Nhập password(Ít nhất 8 ký tự):</div>
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Confirm Password" name="password_confirmation" id="password_confirmation" required minlength="8" class="form-control form-control-user mb-3">
                            <div class="invalid-feedback">Nhập kiếm tra password(Ít nhất 8 ký tự):</div>
                        </div>
                        <button id="loader" type="submit"  class="btn btn-purple" style="padding-top: 10px; padding-bottom: 10px" > {{trans('message.sgup')}}</button>
                    </form>
                </div>
                <div class="mt-3" style="font-size: 14px">{{trans('message.account')}}? <a href="{{route("login")}}" ><span style="color: #b9256a;">{{trans('message.lgin')}}</span></a> </div>
            </div>
        </div>
        @if ($errors->any())
            <section class="alert alert-danger">
                <div class="container">
                    <div class="columns is-centered">
                        <div class="column is-6">
                            <div class="notification is-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <div class="col col-lg-8 bgr text-center img_hide" style="line-height: 700px">
            <img src="http://congtyphuongdong.vn/wp-content/uploads/2019/10/7d6c4c504cb3aaedf3a2.jpg" width="600" height="400">
        </div>
    </div>
</div>
</body>
<script src="{{asset('public/frontend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/javascripts/application.js')}}" type="text/javascript" charset="utf-8" async defer></script>
<!-- Core plugin JavaScript-->
<script src="{{asset('public/frontend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<!-- Custom scripts for all pages-->
<script src="{{asset('public/frontend/js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/chart.js/Chart.min.js')}}"></script>
<!-- Page level custom scripts -->
<script src="{{asset('public/frontend/js/demo/chart-area-demo.js')}}"></script>

<script type="text/javascript">
    (function() {
        'use strict';
        window.addEventListener('load', function() {


            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
</html>
