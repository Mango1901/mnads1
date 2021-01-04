@extends('admin_layout', ['title' => 'User'])
@section('content')
<form id="create-menu"  class="outer-repeater needs-validation" enctype="multipart/form-data" action="{{route("user.store")}}" novalidate  method="post">
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
			<div class="col-12" >
				<div class="card" style="height: 100%" >
					<div class="card-body" id="loader">

						<div class="row">
							<div class="col-xl-9">
								<div class="form-group">
									<label for="projectname">Username</label>
									<input type="text" id="user_name" name="username" maxlength="20" class="form-control" required/>
                                    <div class="invalid-feedback">Nhập username:</div>
                                </div>
                                <div class="form-group">
									<label for="projectname">Password</label>
									<input type="password" id="password" name="password" minlength="8" class="form-control" required />
                                    <div class="invalid-feedback">Nhập password:</div>
                                </div>
                                <div class="form-group">
                                    <label for="projectname">RePassword</label>
                                    <input type="password" id="password" name="password_confirmation" minlength="8" class="form-control" required />
                                    <div class="invalid-feedback">Nhập Repassword:</div>
                                </div>
                                <div class="form-group">
									<label for="projectname">Email</label>
								    <input type="text" id="email" name="email" maxlength="40" class="form-control" required />
                                    <div class="invalid-feedback">Nhập Email:</div>
                                </div>
                                <div class="form-group">
									<label for="projectname">FullName</label>
									<input type="text" id="fullname" name="fullname" maxlength="30" class="form-control" required />
                                    <div class="invalid-feedback">Nhập full name:</div>
                                </div>
                                <div class="form-group">
									<label for="projectname">Website</label>
									<input type="text" id="website" name="website" maxlength="45" class="form-control" required />
                                    <div class="invalid-feedback">Nhập domain website:</div>
                                </div>
                                <div class="form-group">
                                        <label><input type="checkbox" id="active" name="active" value="1">Active</label>
{{--									<label for="projectname">Active</label>--}}
{{--									<input type="number" value="1" min="0" max="1" id="active" name="active" class="form-control" required />--}}
{{--                                    <div class="invalid-feedback">Max value = 1 and min = 0:</div>--}}
								</div>

							</div> <!-- end col-->
						</div> <!-- end col-->
					</div>
					<!-- end row -->
					<div class="row mt-3" id="loader">
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
<style type="text/css">
    .red{
        color: red;
    }
</style>
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

