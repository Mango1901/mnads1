@extends('admin_layout', ['title' => 'User'])
@section('content')
<form id="update-user"enctype="multipart/form-data" action="{{action('Admin\UserController@update')}}"  method="post">
	{{ csrf_field() }}
	<!-- Start Content-->
	<div class="container-fluid">
		<!-- start page title -->
		<div class="row">
			<div class="col-12">
				<div class="page-title-box">

					<h4 class="page-title">Create Users</h4>
				</div>
			</div>
		</div>
		<!-- end page title -->
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
   				<input type="hidden" value="{{$data->id}}" id="id" name="id">
						<div class="row">
							<div class="col-xl-9">
								<div class="form-group">
									<label for="projectname">Username</label>
									<input type="text" value="{{$data->username}}" id="username" readonly name="user_name" class="form-control" />

{{--									<label for="projectname">Password</label>--}}
{{--									<input type="password" value="{{$data->password}}"  id="password" name="password" class="form-control" />--}}

									<label for="projectname">Email</label>
							    	<input type="text" id="email" value="{{$data->email}}"  name="email" class="form-control" />
									<label for="projectname">FullName</label>
									<input type="text" id="fullname" value="{{$data->fullname}}"  name="fullname" class="form-control" />

									<label for="projectname">Website</label>
									<input type="text" id="website"value="{{$data->website}}"  name="website" class="form-control" />

									<label for="projectname">Active</label>
									<input type="text" id="active"value="{{$data->active}}"  name="active" class="form-control" />
								</div>

							</div> <!-- end col-->
						</div> <!-- end col-->
					</div>
					<!-- end row -->
					<div class="row mt-3">
						<div class="col-12 text-center">
							<button type="submit" class="btn btn-warning waves-effect waves-light m-1" ><i class="fe-check-circle mr-1"></i> Update</button>
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
