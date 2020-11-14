<ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    {{--          <li class="nav-item dropdown no-arrow d-sm-none">--}}
    {{--            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
    {{--              <i class="fas fa-search fa-fw"></i>--}}
    {{--            </a>--}}
    {{--            <!-- Dropdown - Messages -->--}}
    {{--            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">--}}
    {{--              <form class="form-inline mr-auto w-100 navbar-search">--}}
    {{--                <div class="input-group">--}}
    {{--                  <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">--}}
    {{--                  <div class="input-group-append">--}}
    {{--                    <button class="btn btn-primary" type="button">--}}
    {{--                      <i class="fas fa-search fa-sm"></i>--}}
    {{--                    </button>--}}
    {{--                  </div>--}}
    {{--                </div>--}}
    {{--              </form>--}}
    {{--            </div>--}}
    {{--          </li>--}}

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
    <!-- Nav Item - Alerts -->
    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $data->username ?></span>
            <img class="img-profile rounded-circle" src="{{ asset('public/storage/'.$data->avatar) }}">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="{{route('second', ['user', 'profile'])}}">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                {{trans('message.profile')}}
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{route('second', ['user', 'showpassword'])}}">
                <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                {{trans('message.change')}}
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{route('second', ['user', 'logout'])}}">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                {{trans('message.logout')}}
            </a>
        </div>
    </li>

</ul>
