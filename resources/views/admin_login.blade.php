 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link href="{{"public/home/css/bootstrap.css"}}" rel="stylesheet">
    <link href="{{"public/home/css/bootstrap.min.css"}}" rel="stylesheet">
    <script src="{{"public/home/js/bootstrap.js"}}"></script>
    <script src="{{"public/home/js/bootstrap.min.js"}}"></script>
    <link href="{{"public/home/css/font-awesome.min.css"}}" rel="stylesheet">
    <link href="{{"public/home/css/style.css"}}" rel="stylesheet">
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
                <div style="font-size: 14px">{{trans('message.fill')}}</div>

                <div class="mt-5 text-center">
                    <a href="{{ url('/login-facebook') }}" class="btn btn-f" style="color: white; padding: 15px"><i class="fa fa-facebook"></i> <span style=" text-align: center; padding: 20px" >{{trans('message.fb')}}</span> </a>
                </div>
                <div class="mt-3 text-center">
                    <a href="{{ url('/login-google') }}" class="btn btn-outline-danger" style="padding: 15px"><i class="fa fa-google"></i> <span style="text-align: center; padding: 25px" >{{trans('message.gg')}}</span> </a>
                </div>

                <div class="text-center mt-3 mb-3">{{trans('message.or')}}</div>
                <div class="form-group">
                    <form action="{{action('Admin\AdminController@execlogin')}}" method="post">
                        @csrf
                        <input type="text" placeholder="Email or Username" name="email" class="form-control mb-3">
                        <input type="password" placeholder="Password" name="password" class="form-control">

                        <div class="form-check mt-2" style="float: left">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">{{trans('message.save_pass')}}
                            </label>
                        </div>
                        <div style="float: right; margin-top: 10px">
                            <a href="forgot-password" style="color: #b9256a;">{{trans('message.forget_pass')}}</a>
                        </div>
                        <div class="mt-5 text-center">
                            <button type="submit" class="btn btn-purple" style="padding-top: 10px; padding-bottom: 10px" >{{trans('message.lgin')}}</button>
                        </div>
                    </form>
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
            @if (session('error'))
                <div class="alert alert-danger help-block">{{session('error')}}</div>
            @endif
            @if (session('message'))
                <div class="alert alert-success help-block">{{session('message')}}</div>
            @endif
                <div class="mt-3" style="font-size: 14px">{{trans('message.account')}} <a href="register" ><span style="color: #b9256a;">{{trans('message.sgup')}}</span></a></div>
            </div>
        </div>
        <div class="col col-lg-8 bgr text-center img_hide" style="line-height: 700px">
            <img src="http://congtyphuongdong.vn/wp-content/uploads/2019/10/7d6c4c504cb3aaedf3a2.jpg" width="600" height="400">
        </div>
    </div>
</div>
</body>
</html>
