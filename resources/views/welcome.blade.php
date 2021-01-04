<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MNADS</title>

    <script src="{{asset('public/frontend/vendor/jquery/jquery.min.js')}}"></script>
    <link href="{{"public/home/css/bootstrap.css"}}" rel="stylesheet">
    <link href="{{"public/home/css/bootstrap.min.css"}}" rel="stylesheet">
    <script src="{{"public/home/js/bootstrap.js"}}"></script>
    <script src="{{"public/home/js/bootstrap.min.js"}}"></script>
    <link href="{{"public/home/css/font-awesome.min.css"}}" rel="stylesheet">
    <link href="{{"public/home/css/style.css"}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" integrity="sha512-Cv93isQdFwaKBV+Z4X8kaVBYWHST58Xb/jVOcV9aRsGSArZsgAnFIhMpDoMDcFNoUtday1hdjn0nGp3+KZyyFw==" crossorigin="anonymous" />

</head>
<body>

<nav class="navbar navbar-expand-sm justify-content-around border-bottom" id="fixNav">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="http://bbq.dhi.mybluehost.me/congtyphuongdong.vn/wp-content/uploads/2019/10/logo-1024x324.png"
                 alt="logo" style="width: 200px">
        </a>

        <ul class="navbar-nav mr-5">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navdrop">{{trans('message.product')}} <i class="fa fa-angle-down"></i></a>
                <div class="dropdown-content">
                    <a class="dropdown-item" href="#">Link Nhi baby</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Link 1</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Link 1</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Link 1</a>
                </div>
            </li>
            <li class="nav-item ml-4 dropdown">
                <a class="nav-link" href="#">{{trans('message.service')}} <i class="fa fa-angle-down"></i> </a>
                <div class="dropdown-content">
                    <a href="#" class="dropdown-item">Dịch vụ 1</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">Dịch vụ 2</a>
                </div>
            </li>
            <li class="nav-item ml-4">
                <a class="nav-link" href="#">{{trans('message.price')}}</a>
            </li>
            <li class="nav-item ml-4">
                <a class="nav-link" href="#">{{trans('message.blog')}}</a>
            </li>
        </ul>

        <div class="justify-content-end ml-5"><a class="nav-link" href="{{route("login")}}">{{trans('message.login')}}</a></div>
        <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                {{$flag=""}}
                @if(Session::has('language'))
                    @switch(Session::get('language'))
                        @case('EN')
                        <?php $flag="<i class='flag-icon flag-icon-us mr-2'></i>ENGLISH"?>
                        @break
                        @case('VN')
                        <?php $flag="<i class='flag-icon flag-icon-vn mr-2'></i> VIETNAMESE"?>
                        @break
                        @case('Arabic')
                        <?php $flag="<i class='flag-icon flag-icon-ae mr-2'></i> Arabic"?>
                        @break
                        @case('Danish')
                        <?php $flag="<i class='flag-icon flag-icon-dk mr-2'></i> Danish"?>
                        @break
                        @case('Dutch')
                        <?php $flag="<i class='flag-icon flag-icon-nl mr-2'></i> Dutch"?>
                        @break
                        @case('Finnish')
                        <?php $flag="<i class='flag-icon flag-icon-fi mr-2'></i> Finland"?>
                        @break
                        @case('French')
                        <?php $flag="<i class='flag-icon flag-icon-fr mr-2'></i> French"?>
                        @break
                        @case('German')
                        <?php $flag="<i class='flag-icon flag-icon-fr mr-2'></i> German"?>
                        @break
                        @case('Italian')
                        <?php $flag="<i class='flag-icon flag-icon-it mr-2'></i> Italian"?>
                        @break
                        @case('Japanese')
                        <?php $flag="<i class='flag-icon flag-icon-jp mr-2'></i> Japanese"?>
                        @break
                        @case('Korean')
                        <?php $flag="<i class='flag-icon flag-icon-kr mr-2'></i> Korean"?>
                        @break
                        @case('Luxembourgish')
                        <?php $flag="<i class='flag-icon flag-icon-lu mr-2'></i> Luxembourgish"?>
                        @break
                        @case('Norwegian')
                        <?php $flag="<i class='flag-icon flag-icon-no mr-2'></i> Norwegian"?>
                        @break
                        @case('Portuguese')
                        <?php $flag="<i class='flag-icon flag-icon-pt mr-2'></i> Portuguese"?>
                        @break
                        @case('Russian')
                        <?php $flag="<i class='flag-icon flag-icon-ru mr-2'></i> Russian"?>
                        @break
                        @case('Spanish')
                        <?php $flag="<i class='flag-icon flag-icon-es mr-2'></i> Spanish"?>
                        @break
                        @case('Swedish')
                        <?php $flag="<i class='flag-icon flag-icon-se mr-2'></i> Swedish"?>
                        @break
                        @case('Chinese')
                        <?php $flag="<i class='flag-icon flag-icon-cn mr-2'></i> Chinese"?>
                        @break
                        @case('Turkish')
                        <?php $flag="<i class='flag-icon flag-icon-tr mr-2'></i> Turkish"?>
                        @break
                    @endswitch
                @endif
                <strong class="">{!!empty($flag)?'<i class="flag-icon flag-icon-us mr-2"></i> ENGLISH':$flag!!}</strong>
            </a>
            <div class="dropdown-menu dropdown-menu-right p-0">
                <a href="{{route('language.index',['EN'])}}" class="dropdown-item">
                    <i class="flag-icon flag-icon-us mr-2"></i> ENGLISH
                </a>
                <a href="{{route('language.index',['VN'])}}" class="dropdown-item">
                    <i class="flag-icon flag-icon-vn    mr-2"></i> VIETNAMESE
                </a>
                <a href="{{route('language.index',['Arabic'])}}" class="dropdown-item">
                    <i class="flag-icon flag-icon-ae mr-2"></i>Arabic
                </a>
                <a href="{{route('language.index',['Danish'])}}" class="dropdown-item">
                    <i class="flag-icon flag-icon-dk mr-2"></i> Danish
                </a>
                <a href="{{route('language.index',['Dutch'])}}" class="dropdown-item">
                    <i class="flag-icon flag-icon-nl mr-2"></i> Dutch
                </a>
                <a href="{{route('language.index',['Finnish'])}}" class="dropdown-item">
                    <i class="flag-icon flag-icon-fi mr-2"></i>Finland
                </a>
                <a href="{{route('language.index',['French'])}}" class="dropdown-item">
                    <i class="flag-icon flag-icon-fr mr-2"></i> French
                </a>
                <a href="{{route('language.index',['German'])}}" class="dropdown-item">
                    <i class="flag-icon flag-icon-de mr-2"></i>German
                </a>
                <a href="{{route('language.index',['Italian'])}}" class="dropdown-item">
                    <i class="flag-icon flag-icon-it mr-2"></i>Italian
                </a>
                <a href="{{route('language.index',['Japanese'])}}" class="dropdown-item">
                    <i class="flag-icon flag-icon-jp mr-2"></i> Japanese
                </a>
                <a href="{{route('language.index',['Korean'])}}" class="dropdown-item">
                    <i class="flag-icon flag-icon-kr mr-2"></i>Korean
                </a>
                <a href="{{route('language.index',['Luxembourgish'])}}" class="dropdown-item">
                    <i class="flag-icon flag-icon-lu mr-2"></i> Luxembourgish
                </a>
                <a href="{{route('language.index',['Norwegian'])}}" class="dropdown-item">
                    <i class="flag-icon flag-icon-no mr-2"></i> Norwegian
                </a>
                <a href="{{route('language.index',['Portuguese'])}}" class="dropdown-item">
                    <i class="flag-icon flag-icon-pt mr-2"></i> Portuguese
                </a>
                <a href="{{route('language.index',['Russian'])}}" class="dropdown-item">
                    <i class="flag-icon flag-icon-ru mr-2"></i> Russian
                </a>
                <a href="{{route('language.index',['Spanish'])}}" class="dropdown-item">
                    <i class="flag-icon flag-icon-es mr-2"></i> Spanish
                </a>
                <a href="{{route('language.index',['Swedish'])}}" class="dropdown-item">
                    <i class="flag-icon flag-icon-se mr-2"></i> Swedish
                </a>
                <a href="{{route('language.index',['Chinese'])}}" class="dropdown-item">
                    <i class="flag-icon flag-icon-cn mr-2"></i> Chinese
                </a>
                <a href="{{route('language.index',['Turkish'])}}" class="dropdown-item">
                    <i class="flag-icon flag-icon-tr mr-2"></i> Turkish
                </a>
            </div>
        </li>
        </ul>
    </div>
</nav>
<div class="padd" id="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="session-header">
                    <p class="title-left">
                        {{trans('message.platform')}}
                    </p>
                    <p class="description-left">
                        {{trans('message.help')}}
                    </p>
                </div>

                <div class="feature">
                    <a href="#" class="btn btn-purple">{{trans('message.free')}}</a>
                    <a href="#" class="btn btn-clip"><i class="fa fa-caret-right"></i> {{trans('message.clip')}}</a>
                </div>
                <p class="before-left">{{trans('message.promptly')}}</p>
            </div>
            <div class="col-lg-6">
                <div class="banner-right text-center">
                    <img class="img1" src="{{"public/home/img/banner1_index.svg"}}" style="display: inline-block" alt="{{trans('message.platform')}}">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container -->
<div class="container">
    <!-- Row -->
    <div class="row">
        <!-- Section-header -->
        <div class="text-center col-sm-12">
            <h1 class="title">{{trans('message.platform2')}}</h1>
        </div>
        <!-- number -->
        <div class="col-lg-4 col-xs-12">
            <div class="number text-center">
                <img class="img-responsive" src="{{"public/home/img/wall-clock-5887_a8176f44-1984-42c5-9401-0ffc3ed18690.svg"}}" alt="{{trans('message.platform2')}}" />
                <p class=""><span class="counter">{{trans('message.advertise')}}</span></p>
                <span class="benefit-content-con"><p dir="ltr">{{trans('message.des_ad')}}</span>
            </div>
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="number text-center">
                <img class="img-responsive" src="{{"public/home/img/money-box-2286_b5b0334d-dd70-4d00-b2c2-37c5775ee2a3.svg"}}" alt="{{trans('message.platform2')}}" style="width: 64px; height: 64px;"/>
                <p class=""><span class="counter">{{trans('message.trans')}}</span></p>
                <span class="benefit-content-con"><p dir="ltr">{{trans('message.des_trans')}}</span>
            </div>
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="number text-center">
                <img class="img-responsive" src="{{"public/home/img/mouse-1815_a0324f14-6ecb-4ff5-a54a-62ab7dc75140.svg"}}" alt="{{trans('message.platform2')}}" />
                <p class=""><span class="counter">{{trans('message.saving')}}</span></p>
                <span class="benefit-content-con"><p dir="ltr">{{trans('message.des_saving')}}</span>
            </div>
        </div>

        <!-- /number -->
    </div>
</div>

<!--các sản phẩm của novar-->
<div class="bgr padd" id="tool">
    <div class="container">
        <div class="session-header text-center">
            <p class="title">{{trans('message.price_roll')}}</p>
            <p class="title-sub">{{trans('message.des_roll')}}</p>
        </div>
        <div class="row">

            <div class="col col-lg-3 col-sm-12">
                <div class="tool-content text-center mt-5">
                    <p class="tool-content-title">{{trans('message.package1')}}</p><br>
                    <p class="btn btn-danger">{{trans('message.price_package')}}</p>
                    <p class="product-content">{{trans('message.content_package')}}</p>
                    <a href="#" class="btn btn-purple height-button mb-4" onclick="">{{trans('message.sign_up')}}</a>
                </div>
            </div>

            <div class="col col-lg-3 col-sm-12">
                <div class="tool-content text-center mt-5">
                    <p class="tool-content-title ">{{trans('message.package2')}}</p><br>
                    <p class="btn btn-danger">{{trans('message.price_package2')}}</p>
                    <p class="product-content">{{trans('message.content_package2')}}</p>
                    <a href="#" class="btn btn-purple height-button mb-4" onclick="">{{trans('message.sign_up')}}</a>
                </div>
            </div>

            <div class="col col-lg-3 col-sm-12">
                <div class="tool-content text-center mt-5">
                    <p class="tool-content-title ">{{trans('message.package3')}}</p><br>
                    <p class="btn btn-danger">{{trans('message.price_package3')}}</p>
                    <p class="product-content">{{trans('message.content_package2')}}.</p>
                    <a href="#" class="btn btn-purple height-button mb-4" onclick="">{{trans('message.sign_up')}}</a>
                </div>
            </div>

            <div class="col col-lg-3 col-sm-12">
                <div class="tool-content text-center mt-5">
                    <p class="tool-content-title ">{{trans('message.package4')}}</p><br>
                    <p class="btn btn-danger">{{trans('message.price_package4')}}</p>
                    <p class="product-content">{{trans('message.content_package4')}}</p>
                    <a href="#" class="btn btn-purple height-button mb-4" onclick="">{{trans('message.sign_up')}}</a>
                </div>
            </div>


        </div>
    </div>
</div>
<!--Bạn gặp vấn đề -->

<div id="problem-googleads-using" class="padd">

    <!-- Container -->
    <div class="container">
        <div class="text-center">
            <img src="{{"public/home/"}}img/deloy-hot-icon.svg" />
            <span class="problem-googleads-seal-infor">{{trans('message.endow')}}</span>
        </div>
        <div class="problem-googleads-header text-center">
            <h1 class="title">{{trans('message.google_Ads')}}</h1>
            <p class="title-sub">{{trans('message.des_Ads')}}</p>
        </div>
        <!-- Row -->
        <div class="row">
            <!-- Section-header -->
            <!-- number -->
            <div class="col-lg-4 col-xs-12">
                <div class="number text-center benefit-content">
                    <img class="img-responsive" src="{{"public/home/img/deloy-googleSearch-icon.svg"}}" />
                    <p class="benefit-content-title"><span class="counter">{{trans('message.google_search')}}</span></p>
                    <span class="benefit-content-con">{{trans('message.des_search')}}</span>
                    <div style="margin-top: 24px;">
                        <a class="cl-B9256A" target="_blank" href="https://ongoogle.autoads.asia/?utm_source=website&amp;utm_medium=OnGoogle&amp;utm_term=SectionHome">{{trans('message.link_detail')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12">
                <div class="number text-center benefit-content">
                    <img class="img-responsive" src="{{"public/home/img/deloy-googleTag-icon.svg"}}" />
                    <p class="benefit-content-title"><span class="counter">{{trans('message.google_shopping')}}</span></p>
                    <span class="benefit-content-con">{{trans('message.des_shopping')}}</span>
                    <div style="margin-top: 24px;">
                        <a class="cl-B9256A" target="_blank" href="https://ongoogle.autoads.asia/?utm_source=website&amp;utm_medium=OnGoogle&amp;utm_term=SectionHome">{{trans('message.link_detail')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12">
                <div class="number text-center benefit-content">
                    <img class="img-responsive" src="{{"public/home/img/deloy-manageGoogle-icon.svg"}}" />
                    <p class="benefit-content-title"><span class="counter">{{trans('message.account_Ads')}}</span></p>
                    <span class="benefit-content-con">{{trans('message.des_account')}}</span>
                    <div style="margin-top: 24px;">
                        <a class="cl-B9256A" target="_blank" href="#">{{trans('message.link_detail')}}</a>
                    </div>
                </div>
            </div>


        </div>
        <div class="row">
            <!--Xem lộ trình chi tiết-->

        </div>
        <!-- /Row -->
    </div>
    <!-- /Container -->

</div>

<div class="bgr">

    <div class="container pb-5">
        <div class="section-header text-center">
            <p class="title pt-5">{{trans('message.last')}}</p>
            <h2 class="title-sub">{{trans('message.des_last')}}</h2>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="#" class="btn btn-purple pl-5 pr-5">{{trans('message.use_free')}}</a>
            </div>
        </div>
    </div>
</div>

<!--foooter-->
<div class="bgr_footer pt-5">
    <div class="container">
        <div class="mb-4">
            Bla Bla Nhi baby cute hạt me.....
        </div>
        <div class="border-top text-center pt-3 pb-2 font_footer">
            &copy;2020 - {{trans('message.footer')}}<br>
            <a href="#">{{trans('message.rule')}} &</a><a href="#"> {{trans('message.policy')}}</a>
        </div>
    </div>
</div>
</body>
</html>
