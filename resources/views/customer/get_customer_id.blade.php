<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MNADS - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('public/frontend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('public/frontend/css/sb-admin-2.min.css')}}" rel="stylesheet">
</head>

<body>
<div class="text-center">
    <h1 class="h4 text-gray-900 mb-4">Choose your customer_id</h1>
</div>
<form class="user" action="{{route('googleAds.get.google.report')}}"  method="post">
    {{ csrf_field() }}
<select name="customer_id" class="form-control input-sm m-bot15">
        @foreach($customers_id as $value)
        <option value="{{$value}}">{{$value}}</option>
        @endforeach
</select>
    <button type="submit" class="btn btn-primary btn-user btn-block" >Choose</button>
</form>
</body>
<script src="{{asset('public/frontend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('public/frontend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('public/frontend/js/sb-admin-2.min.js')}}"></script>
