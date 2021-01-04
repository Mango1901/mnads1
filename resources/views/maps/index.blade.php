@extends('admin_layout', ['title' => 'Maps'])
@section('content')
<div class="row container">
  <div class="col-sm-4">
    <a href="{{route("maps.create")}}" class=" btn btn-success waves-effect waves-success mb-3"><i class="fas fa-plus-square"></i> {{trans('message.create')}} </a>
  </div>
    @if (session('message'))
        <div class="alert alert-success help-block">{{session('message')}}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger help-block">{{session('error')}}</div>
    @endif
  <table class="table table-bordered"  style="word-break: break-all">
    <thead>
      <tr>
          <th  scope="col">{{trans('message.map_title')}}</th>
        <th  scope="col">{{trans('message.map')}}</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($getMaps as $item)
       <tr>
           <td style="word-break: break-word;">{{$item->map_title}} </td>
        <td style="word-break: break-word;">{{$item->map}} </td>
        <td><a href="{{route("maps.edit",["id"=>$item->id])}}" data-toggle="tooltip" title="" class="btn btn-xs  btn-warning" data-original-title="Edit"> <i class="fas fa-edit "></i></a> </td>
        <td><a href="{{route("maps.delete",["id"=>$item->id])}}" data-toggle="tooltip" title="" onclick="return confirm('Are you want to delete?')" class="btn btn-xs btn-danger delete-confirm" data-original-title="Delete"><i class="fas fa-trash-alt"></i></a> </td>
      </tr>
      @endforeach


    </tbody>
  </table>
</div>
@endsection

