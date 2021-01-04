@extends('admin_layout', ['title' => 'User'])
@section('content')
<form id="update-user" class="outer-repeater needs-validation" enctype="multipart/form-data" action="{{route("user.update")}}" novalidate  method="post">
	{{ csrf_field() }}
	<!-- Start Content-->
	<div class="container-fluid">
		<!-- start page title -->
		<div class="row">
			<div class="col-12">
				<div class="page-title-box">

					<h4 class="page-title">Update Users</h4>
				</div>
			</div>
		</div>
		<!-- end page title -->
		<div class="row"  id="loader">
			<div class="col-12">
				<div class="card" style="height: 100%">
					<div class="card-body">
   				<input type="hidden" value="{{$edit->id}}" id="id" name="id">
						<div class="row">
							<div class="col-xl-9">
								<div class="form-group">
									<label for="projectname">Username</label>
									<input type="text" value="{{$edit->username}}" id="username" maxlength="20"  name="username" class="form-control" required />
                                    <div class="invalid-feedback">Nhập username: </div>
                                </div>
                                <div class="form-group">
									<label for="projectname">Email</label>
							    	<input type="email" id="email" value="{{$edit->email}}"  name="email" maxlength="30"   class="form-control" required />
                                    <div class="invalid-feedback">Nhập email: </div>
                                </div>
                                <div class="form-group">
									<label for="projectname">FullName</label>
									<input type="text" id="fullname" value="{{$edit->fullname}}" maxlength="30"  name="fullname" class="form-control" required />
                                    <div class="invalid-feedback">Nhập họ và tên (tối đa 30 kí tự):</div>
                                </div>
                                <div class="form-group">
									<label for="projectname">Website</label>
									<input type="text" id="website" value="{{$edit->website}}" maxlength="35"  name="website" class="form-control" />
                                </div>
                                <div class="form-group">
                                    @if(\Illuminate\Support\Facades\Session::get("active") == 1)
                                    <label><input type="checkbox" id="active" name="active" checked value="1">Active</label>
                                    @else
                                        <label><input type="checkbox" id="active" name="active" value="1">Active</label>
                                    @endif


{{--									<label for="projectname">Active</label>--}}
{{--									<input type="number" id="active" value="{{$edit->active}}"  name="active" class="form-control" required />--}}
{{--                                    <div class="invalid-feedback">Max value = 1 and min = 0:</div>--}}
								</div>

							</div> <!-- end col-->
						</div> <!-- end col-->
					</div>
					<!-- end row -->
					<div class="row mt-3">
						<div class="col-12 text-center" id="loader">
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
