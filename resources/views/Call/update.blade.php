@extends('admin_layout', ['title' => 'Call'])
@section('content')
<form  class="outer-repeater needs-validation" id="update-user" action="{{route("call.update")}}" novalidate  method="post">
    {{ csrf_field() }}
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">

                    <h4 class="page-title">Update Call</h4>
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
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card" style="height: 100%" id="loader">
                    <div class="card-body">
                <input type="hidden" value="{{$edit_call->id}}" id="id" name="id">
                        <div class="row">
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <label for="projectname">{{trans('message.name_call')}}<span class="red">*</span></label>
                                    <input type="text" value="{{($edit_call->name)}}" id="time" name="name" class="form-control" maxlength="50" required />
                                    <div class="invalid-feedback">Nhập tên</div>
                                </div>
                                <div class="form-group">
                                    <label for="projectname">{{trans('message.phone_call')}}<span class="red">*</span></label>
                                    <input type="number" value="{{($edit_call->phone_number)}}"
                                    oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" id="phone" name="phone" maxlength="11" class="form-control" required />
                                    <div class="invalid-feedback">Nhập số điện thoại</div>
                                </div>
                                <div class="form-group">
                                    <label for="projectname">{{trans('message.description_call')}}</label>
                                    <input type="text" value="{{($edit_call->description)}}" id="description" name="description" maxlength="255" class="form-control"/>
                                </div>

                            </div> <!-- end col-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->
                    <div class="row mt-3" >
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-warning waves-effect waves-light m-1" ><i class="fe-check-circle mr-1"></i> {{trans('message.update')}}</button>
                            <button type="button" class="btn btn-danger waves-effect waves-light m-1"  onclick="window.location='{{ URL::previous() }}'"><i class="fe-x mr-1"></i>{{trans('message.cancel')}}</button>
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
<style type="text/css">
    .red{
        color: red;
    }
</style>
@section('script')

<!-- bootstrap datepicker -->
<script src="{{ URL::asset('/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<!-- Summernote js -->
<script src="{{ URL::asset('/libs/summernote/summernote.min.js')}}"></script>
<!-- form repeater js -->
<script src="{{ URL::asset('/libs/jquery-repeater/jquery-repeater.min.js')}}"></script>
<script src="{{ URL::asset('/js/pages/task-create.init.js')}}"></script>
<script>
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
