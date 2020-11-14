@extends('admin_layout', ['title' => 'User'])
@section('content')
<form id="create-menu"enctype="multipart/form-data" action="{{action('Admin\UserController@store')}}"  method="post">
	{{ csrf_field() }}
	<!-- Start Content-->
	<div class="container-fluid">
		<!-- start page title -->
		<div class="row">
			<div class="col-12">
				<div class="page-title-box">
					<h4 class="page-title">{{trans('message.create')}}</h4>
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
									<label for="projectname">Username</label>
									<input type="text" id="user_name" name="username" class="form-control" />

									<label for="projectname">Password</label>
									<input type="password" id="password" name="password" class="form-control" />
                                    <label for="projectname">RePassword</label>
                                    <input type="password" id="password" name="password_confirmation" class="form-control" />

									<label for="projectname">Email</label>
								    <input type="text" id="email" name="email" class="form-control" />

									<label for="projectname">FullName</label>
									<input type="text" id="fullname" name="fullname" class="form-control" />

									<label for="projectname">Website</label>
									<input type="text" id="website" name="website" class="form-control" />

									<label for="projectname">Active</label>
									<input type="text" id="active" name="active" class="form-control" />
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
				</div> <!-- end card-body -->
			</div> <!-- end card-->
		</div> <!-- end col-->
	</div>
	<!-- end row-->

</div> <!-- container -->

    </form>
@endsection
