@extends('admin_layout', ['title' => 'User'])
@section('content')
 <div class="row">
        <div class="col-sm-4">
            <a href="{{route("call.create")}}" class=" btn btn-success waves-effect waves-success mb-3"><i class="fas fa-plus-square"></i> {{trans('message.creat_call')}} </a>
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
                <th scope="col">{{trans('message.name_call')}}</th>
                <th scope="col">{{trans('message.phone_call')}}</th>
                <th scope="col" style="word-break: break-all">{{trans('message.description_call')}}</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($get_call as $item)
              <tr>
                <td>{{$item->name}}</td>
                <td>{{$item->phone_number}}</td>
                <td>{{$item->description}}</td>
                <td><a href="{{route("call.edit",['id'=>$item->id])}}" data-toggle="tooltip" title="" class="btn btn-xs  btn-warning" data-original-title="Edit"> <i class="fas fa-edit "></i></a> </td>
                <td><a href="{{route("call.delete",['id'=>$item->id])}}" data-toggle="tooltip" title="" class="btn btn-xs btn-danger delete-confirm" data-original-title="Delete" onclick="return confirm('Are you want to delete?')"><i class="fas fa-trash-alt"></i></a> </td>

              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
@endsection

