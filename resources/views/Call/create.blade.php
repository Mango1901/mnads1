@extends('admin_layout',['title' => 'Call'])
@section('content')
    <form class="outer-repeater needs-validation" id="create-menu" action="{{route("call.store")}}" novalidate  method="post">
    {{ csrf_field() }}
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">{{trans('message.creat_call')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
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
            <div class="col-12">
                <div class="card" style="height: 100%" id="loader">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <label for="projectname1">{{trans('message.name_call')}}<span class="red">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control" maxlength="50" required/>
                                    <div class="invalid-feedback">Nhập tên</div>
                                </div>
                                <div class="form-group">
                                    <label for="projectname2">{{trans('message.phone_call')}}<span class="red">*</span></label>
                                    <input type = "number" id="phone_number" name="phone_number" class="form-control"  oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "11" required />
                                    <div class="invalid-feedback">Nhập số điện thoại(tối đa 11 số)</div>
                                </div>
                                <div class="form-group">
                                    <label for="projectname3">{{trans('message.description_call')}}</label>
                                    <input type="text" id="description" name="description" class="form-control" maxlength="255"/>
{{--                                    <div class="invalid-feedback">Nhập số mô tả</div>--}}
                                </div>

                            </div> <!-- end col-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->
                    <div class="row mt-3">
                        <div class="col-12 text-center" >
                            <button type="submit" class="btn btn-success waves-effect waves-light m-1" ><i class="fe-check-circle mr-1"></i> {{trans('message.creat_call')}}</button>
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
    <script>
    (function() {
    'use strict';
    window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
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
