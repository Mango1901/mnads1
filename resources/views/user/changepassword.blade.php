@extends('admin_layout', ['title' => 'Call'])
@section('content')
<form id="create-menu" class="outer-repeater needs-validation" action="{{route("user.change.password")}}" novalidate  method="post">
    {{ csrf_field() }}
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">

                    <h4 class="page-title">CHANGE PASSWORD</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card" style="height: 100%" id="loader">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <label for="projectname">Old password</label>
                                    <input type="password" id="oldpassword" name="oldpassword" minlength="8" class="form-control" required />
                                    <div class="invalid-feedback">Nhập Mật khẩu cũ (ít nhất 8 kí tự):</div>
                                    <label for="projectname">New password</label>
                                    <input type="password" id="password" name="password" minlength="8" class="form-control" required />
                                    <div class="invalid-feedback">Nhập Mật khẩu mới(ít nhất 8 kí tự):</div>
                                    <label for="projectname">Enter the new password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" minlength="8" class="form-control" required />
                                    <div class="invalid-feedback">Nhập lại mật khẩu mới(ít nhất 8 kí tự):</div>

                                </div>

                            </div> <!-- end col-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->
                    <div class="row mt-3">
                        <div class="col-12 text-center" >
                            <button type="submit" class="btn btn-success waves-effect waves-light m-1" ><i class="fe-check-circle mr-1"></i> Update</button>
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
                  @if (session('status'))
                    <div class="alert alert-success help-block">{{session('status')}}</div>
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
