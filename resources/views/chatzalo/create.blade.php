@extends('admin_layout', ['title' => 'ChatZalo'])
{{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">--}}
@section('content')
<form class="outer-repeater needs-validation" id="create-menu" action="{{route("chatzalo.store")}}" novalidate  method="post">
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

                        <div class="row">
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <label for="projectname">{{__('zalo_title')}}<span class="red">*</span></label>
                                    <input type="text" id="zaloname" name="zalo_title" maxlength="50" class="form-control" required />
                                    <div class="invalid-feedback">Nhập tên Zalo</div>
                                </div>
                                <div class="form-group">
                                    <label for="projectname">{{trans('message.name_zalo')}}<span class="red">*</span></label>
                                    <input type="text" value="{{old('zalo-name')}}" id="zaloname" name="zalo_name" maxlength="50" class="form-control" required />
                                     <div class="invalid-feedback">Nhập tên Zalo</div>
                                </div>

                            </div> <!-- end col-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->
                    <div class="row mt-3" >
                        <div class="col-12 text-center" >
                            <button type="submit" class="btn btn-success waves-effect waves-light m-1" ><i class="fe-check-circle mr-1"></i> {{trans('message.create')}}</button>
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
