@extends('admin_layout', ['title' => 'ChatFaceBook'])
@section('content')
<div class="row container">
  <div class="col-sm-4">
    <a href="create" class=" btn btn-success waves-effect waves-success mb-3"><i class="fas fa-plus-square"></i> {{trans('message.create')}} </a>
  </div>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">STT</th>
        <th scope="col">Facebook id</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php $stt = 1; ?>
      @foreach ($data as $item)
       <tr>
        <th scope="row">{{ $stt++ }}</th>
        <td>{{$item->facebook_id}} </td>
        <td><a href="edit/{{$item->id}}" data-toggle="tooltip" title="" class="btn btn-xs  btn-warning" data-original-title="Edit"> <i class="fas fa-edit "></i></a> </td>
        <td><a href="delete/{{$item->id}}" data-toggle="tooltip" title="" class="btn btn-xs btn-danger delete-confirm" onclick="return confirm('Delete record {{$stt}}')" data-original-title="Delete"><i class="fas fa-trash-alt"></i></a> </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

