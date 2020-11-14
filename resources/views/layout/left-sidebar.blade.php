<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('second',['chart','index'])}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-ad"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{trans('message.systemadmin')}}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">

        <a class="nav-link" href="{{route('second',['chart','index'])}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{trans('message.dash')}}</span></a>
    </li>

    <!--Setting user -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
           aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{trans('message.user')}}</span>
        </a>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('second', ['call', 'index'])}}"><i class="fas fa-phone-square-alt"></i> {{trans('message.call')}}</a>
                <a class="collapse-item" href="{{route('second', ['chatfacebook', 'index'])}}"><i class="fab fa-facebook-square"></i> {{trans('message.fbchat')}}</a>
                <a class="collapse-item" href="{{route('second', ['chatzalo', 'index'])}}"><i class="fas fa-comments"></i> {{trans('message.zalochat')}}</a>
                <a class="collapse-item" href="{{route('second', ['contact', 'index'])}}"><i class="fas fa-address-book"></i> {{trans('message.contact')}}</a>
                <a class="collapse-item" href="{{route('second', ['maps', 'index'])}}"><i class="fas fa-map-marker-alt"></i> {{trans('message.map')}}</a>
                <a class="collapse-item" href="{{route('google.report.list')}}"><i class="fas fa-map-marker-alt"></i> {{trans('message.getReport1')}}</a>

            </div>
        </div>
    </li>

    <!--Logs -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
           aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{trans('message.history')}}</span>
        </a>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('second',['calllog','index'])}}"><i class="fas fa-phone-square-alt"></i> {{trans('message.call')}}</a>
                <a class="collapse-item" href="{{route('second',['chatfblog','index'])}}"><i class="fab fa-facebook-square"></i> {{trans('message.fbchat')}}</a>
                <a class="collapse-item" href="{{route('second',['chatzalolog','index'])}}"><i class="fas fa-comments"></i> {{trans('message.zalochat')}}</a>
                <a class="collapse-item" href="{{route('second',['contactlog','index'])}}"><i class="fas fa-address-book"></i> {{trans('message.contact')}}</a>
                <a class="collapse-item" href="{{route('second',['maplog','index'])}}"><i class="fas fa-map-marker-alt"></i> {{trans('message.map')}}</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">


        <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('second', ['user', 'index'])}}">
            <i class="fas fa-users"></i>
            <span>{{trans('message.userinfo')}}</span></a>
    </li>


    <!-- Divider -->


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->


