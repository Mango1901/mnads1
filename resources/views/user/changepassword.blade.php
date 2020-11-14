@extends('admin_layout', ['title' => 'Call'])
@section('content')

<form id="create-menu" action="{{action('Admin\UserController@changepassword')}}"  method="post">
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
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <label for="projectname">Old password</label>
                                    <input type="password" id="oldpassword" name="oldpassword" class="form-control" />
                                    <label for="projectname">New password</label>
                                    <input type="password" id="password" name="password" class="form-control />
                                    <label for="projectname">Enter the new password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" />

                                </div>

                            </div> <!-- end col-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->
                    <div class="row mt-3">
                        <div class="col-12 text-center">
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
                    <div class="alert alert-danger help-block">{{session('status')}}</div>
                  @endif
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->

</div> <!-- container -->

    </form>
@endsection
