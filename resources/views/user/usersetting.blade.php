@extends('admin_layout', ['title' => 'Call'])
@section('content')
<form id="create-menu" class="outer-repeater needs-validation" action="{{route('user.update.profile')}}"  method="POST" novalidate enctype="multipart/form-data">
    {{ csrf_field() }}
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">

                    <h4 class="page-title">UPDATE PROFILE</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card" id="loader" style="height: 100%">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <label for="projectname">Full Name</label>
                                    <input type="text" id="fullname" name="fullname" maxlength="20" class="form-control" value="{{$profile->fullname}}" />
                                    <div class="invalid-feedback">Nhập họ và tên (tối đa 30 kí tự):</div>
                                </div>
                                <div class="form-group">
                                    <label for="projectname">Website</label>
                                    <input type="text" id="website" name="website" maxlength="45" class="form-control" value="{{$profile->website}}" />
                                </div>
                                <div class="form-group">
                                    <label for="projectname">Company Name</label>
                                    <input type="text" id="company_name" name="company_name" maxlength="50" class="form-control" value="{{$profile->company_name}}" />
                                </div>
                                <div class="form-group">
                                    <label for="projectname">Description</label>
                                    <input type="text" id="description" name="description" maxlength="255" class="form-control" value="{{$profile->description}}" />
                                </div>
                                <div class="form-group">
                                    <label for="projectname">Avatar:</label>
                                    <img src="{{url("public/avatar/".$profile->avatar)}}"/>
                                    <input type="file" name="image">
                                </div>

                            </div> <!-- end col-->
                        </div> <!-- end col-->
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
                    <!-- end row -->
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success waves-effect waves-light m-1" ><i class="fe-check-circle mr-1"></i> Update</button>
{{--                            <button type="button" class="btn btn-light waves-effect waves-light m-1"  onclick="window.location='{{ URL::previous() }}'"><i class="fe-x mr-1"></i>Cancel</button>--}}
                        </div>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->

</div> <!-- container -->

    </form>
@endsection
@section('script')
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
@endsection
