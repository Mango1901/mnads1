@extends('admin_layout', ['title' => 'Call'])
@section('content')
<form id="create-menu" action="{{action('Admin\UserController@updateprofile')}}"  method="post" method="POST" enctype="multipart/form-data">
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
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <label for="projectname">Full Name</label>
                                    <input type="text" id="fullname" name="fullname" class="form-control" value="{{$data->fullname}}" />
                                    <label for="projectname">Website</label>
                                    <input type="text" id="website" name="website" class="form-control" value="{{$data->website}}" />
                                    <label for="projectname">Company Name</label>
                                    <input type="text" id="company_name" name="company_name" class="form-control" value="{{$data->company_name}}" />
                                    <label for="projectname">Description</label>
                                    <input type="text" id="description" name="description" class="form-control" value="{{$data->description}}" />
                                    <label for="projectname">Avatar</label>
                                    <input type="text" id="avatar" name="avatar" class="form-control" value="{{$data->avatar}}" />
                                    <input type="file" name="image">
                                </div>

                            </div> <!-- end col-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success waves-effect waves-light m-1" ><i class="fe-check-circle mr-1"></i> Create</button>
                            <button type="button" class="btn btn-light waves-effect waves-light m-1"  onclick="window.location='{{ URL::previous() }}'"><i class="fe-x mr-1"></i>Cancel</button>
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
