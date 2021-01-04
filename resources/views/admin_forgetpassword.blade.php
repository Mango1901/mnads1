{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}

{{--<head>--}}

{{--  <meta charset="utf-8">--}}
{{--  <meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
{{--  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">--}}
{{--  <meta name="description" content="">--}}
{{--  <meta name="author" content="">--}}

{{--  <title>MNADS - Login</title>--}}

{{--  <!-- Custom fonts for this template-->--}}
{{--  <link href="{{('public/frontend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">--}}
{{--  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">--}}

{{--  <!-- Custom styles for this template-->--}}
{{--  <link href="{{('public/frontend/css/sb-admin-2.min.css')}}" rel="stylesheet">--}}

{{--</head>--}}

{{--<body class="bg-gradient-primary">--}}

{{--  <div class="container">--}}

{{--    <!-- Outer Row -->--}}
{{--    <div class="row justify-content-center">--}}

{{--      <div class="col-xl-6 col-lg-6 col-md-6">--}}

{{--        <div class="card o-hidden border-0 shadow-lg my-5">--}}
{{--          <div class="card-body p-0">--}}
{{--            <!-- Nested Row within Card Body -->--}}
{{--            <div class="row">--}}
{{--              <div class="col-lg-12">--}}
{{--                <div class="p-5">--}}
{{--                  <div class="text-center">--}}
{{--                    <h1 class="h4 text-gray-900 mb-4">FORGOT PASSWORD SYSTEM!</h1>--}}
{{--                  </div>--}}
{{--                  <form class="user" action="{{action('Admin\AdminController@sent')}}"  method="post">--}}
{{--                     {{ csrf_field() }}--}}
{{--                    <div class="form-group">--}}
{{--                      <input type="email" class="form-control form-control-user" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">--}}
{{--                    </div>--}}
{{--                    <button id="loader" type="submit" class="btn btn-primary btn-user btn-block"> Sent</button>--}}
{{--                    @if ($errors->any())--}}
{{--                          <section class="alert alert-danger">--}}
{{--                              <div class="container">--}}
{{--                                  <div class="columns is-centered">--}}
{{--                                      <div class="column is-6">--}}
{{--                                          <div class="notification is-danger">--}}
{{--                                              <ul>--}}
{{--                                                  @foreach ($errors->all() as $error)--}}
{{--                                                      <li>{{ $error }}</li>--}}
{{--                                                  @endforeach--}}
{{--                                              </ul>--}}
{{--                                          </div>--}}
{{--                                      </div>--}}
{{--                                  </div>--}}
{{--                              </div>--}}
{{--                          </section>--}}
{{--                    @endif--}}
{{--                  </form>--}}
{{--                    @if (session('error'))--}}
{{--                        <div class="alert alert-danger help-block">{{session('error')}}</div>--}}
{{--                    @endif--}}
{{--                  <hr>--}}
{{--                  <div class="text-center">--}}
{{--                    <a class="small" href="login">Already have an account? Login!</a>--}}
{{--                  </div>--}}
{{--                  <div class="text-center">--}}
{{--                    <a class="small" href="register">Create an Account!</a>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}

{{--      </div>--}}

{{--    </div>--}}

{{--  </div>--}}

{{--  <!-- Bootstrap core JavaScript-->--}}
{{--  <script src="{{('public/frontend/vendor/jquery/jquery.min.js')}}"></script>--}}
{{--  <script src="{{('public/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>--}}

{{--  <!-- Core plugin JavaScript-->--}}
{{--  <script src="{{('public/frontend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>--}}

{{--  <!-- Custom scripts for all pages-->--}}
{{--  <script src="{{('public/frontend/js/sb-admin-2.min.js')}}"></script>--}}

{{--</body>--}}

{{--</html>--}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>

    <link href="{{"public/home/css/bootstrap.css"}}" rel="stylesheet">
    <link href="{{"public/home/css/bootstrap.min.css"}}" rel="stylesheet">
    <script src="{{"public/home/js/bootstrap.js"}}"></script>
    <script src="{{"public/home/js/bootstrap.min.js"}}"></script>
    <link href="{{"public/home/css/font-awesome.min.css"}}" rel="stylesheet">
    <link href={{"public/home/css/style.css"}}"" rel="stylesheet">
</head>
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
                <div style="font-size: 14px; padding-bottom: 10px">{{trans('message.fill')}}</div>

                <div class="form-group">
                    <form class="user" action="{{action('Admin\AdminController@sent')}}"  method="post">
                        @csrf
                    <div class="form-group">
                        <input type="text" name="email" id="email" aria-describedby="emailHelp" class="form-control" placeholder="Enter Email Address...">
                    </div>
                    <button id="loader" type="submit" class="btn btn-primary btn-user btn-block"> {{trans('message.send')}}</button>
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
                  </form>
                    @if (session('error'))
                        <div class="alert alert-danger help-block">{{session('error')}}</div>
                    @endif
                    </form>
                </div>
                <div class="mt-3" style="font-size: 14px">{{trans('message.account')}} <a href="{{route("login")}}" ><span style="color: #b9256a;">{{trans('message.lgin')}}</span></a><span> ||</span> <a href="{{route("register")}}" ><span style="color: #b9256a;">{{trans('message.sgup')}}</span></a></div>
            </div>
        </div>
        <div class="col col-lg-8 bgr text-center img_hide" style="line-height: 700px">
            <img src="http://congtyphuongdong.vn/wp-content/uploads/2019/10/7d6c4c504cb3aaedf3a2.jpg" width="600" height="400">
        </div>
    </div>
</div>
</body>
</html>
