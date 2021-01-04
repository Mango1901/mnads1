@extends('admin_user_layout', ['title' => 'User'])
@section('content')
<div class="row container">
  <div class="col-sm-4">
    <a href="{{route("user.create")}}" class=" btn btn-success waves-effect waves-success mb-3"><i class="fas fa-plus-square"></i> {{trans('message.create')}} </a>
  </div>
    @if (session('message'))
        <div class="alert alert-success help-block">{{session('message')}}</div>
    @endif
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">STT</th>
        <th scope="col">{{trans('message.username')}}</th>
{{--        <th scope="col">{{trans('message.password')}}</th>--}}
        <th scope="col">Email</th>
        <th scope="col">Website</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php $stt = 1; ?>
      @foreach($getUser as $item)
      <tr>
        <th scope="row">{{ $stt++ }}</th>
        <td>{{$item->username}}</td>
{{--        <td>{{$item->password}}</td>--}}
        <td>{{$item->email}}</td>
        <td>{{$item->website}}</td>
        <td><a href="{{route("user.edit",['id'=>$item->id])}}" data-toggle="tooltip" title="" class="btn btn-xs  btn-warning" data-original-title="Edit"> <i class="fas fa-edit "></i></a> </td>
        <td><a href="{{route("user.delete",['id'=>$item->id])}}" data-toggle="tooltip" title="" class="btn btn-xs btn-danger delete-confirm" data-original-title="Delete" onclick="return confirm('Are you want to delete?it will delete all the information related')"><i class="fas fa-trash-alt"></i></a> </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

