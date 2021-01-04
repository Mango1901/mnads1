@extends('admin_layout', ['title' => 'ChatFaceBook'])
@section('content')
<div class="row container">
  <div class="col-sm-4">
    <a href="{{route("chatfacebook.create")}}" class=" btn btn-success waves-effect waves-success mb-3"><i class="fas fa-plus-square"></i> {{trans('message.create')}} </a>
  </div>
    @if (session('message'))
        <div class="alert alert-success help-block">{{session('message')}}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger help-block">{{session('error')}}</div>
    @endif
  <table class="table table-bordered">
    <thead>
      <tr>
          <th scope="col">Facebook Title</th>
        <th scope="col">Facebook id</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($getChatFaceBookByUser as $item)
       <tr>
         <td>{{$item->facebook_title}} </td>
        <td style="word-break: break-all">{{$item->facebook_id}} </td>
        <td><a href="{{route("chatfacebook.edit",['id'=>$item->id])}}" data-toggle="tooltip" title="" class="btn btn-xs  btn-warning" data-original-title="Edit"> <i class="fas fa-edit "></i></a> </td>
        <td><a href="{{route("chatfacebook.delete",['id'=>$item->id])}}" data-toggle="tooltip" title="" class="btn btn-xs btn-danger delete-confirm" onclick="return confirm('Are you want to delete?')" data-original-title="Delete"><i class="fas fa-trash-alt"></i></a> </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

