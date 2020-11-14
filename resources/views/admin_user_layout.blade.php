<!DOCTYPE html>
<html lang="en">

<head>

    @include('layout/head-css')

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    @include('layout/left-sidebar')

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <div class="col-xl-12" style="height: 70px;background-color: #4e73df;text-align: center">
                    <span style="color: white;padding-top: 20px;line-height: 70px">{{$data->company_name}}</span>
            </div>
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                @include('layout/seach_user')

                @include('layout/profile')

            </nav>

            <div class="container-fluid">
                @yield('content')
            </div>


            <!-- Footer -->
        @include('layout/footer')
        <!-- End of Footer -->

        </div>

    </div>
</div>
@include('layout/footer-js')
</body>

</html>
