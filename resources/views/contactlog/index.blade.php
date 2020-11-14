@extends('admin_layout', ['title' => 'ChatFaceBook'])
@section('content')
<div class="row container">
    <form id="form1" action="{{action("Admin\ContactlogController@index")}}" method="get" class="form-group">
        <div class="col-md-12" style="display: flex">
            <div class="col-md-6">
                <select id="paginate" class="form-control">
                    <option {{(isset($paginator)&&$paginator==1)?'selected':''}}  value="1">20</option>
                    <option {{isset($paginator)&&$paginator==2?'selected':''}} value="2">30</option>
                    <option {{isset($paginator)&&$paginator==3?'selected':''}} value="3">40</option>
                    <option {{isset($paginator)&&$paginator==4?'selected':''}} value="4">50</option>
                </select>
                <input id="paginator" type="hidden" name="paginator" value="">
            </div>
            <div class="col-md-6">
                <a class="btn btn-primary" href="{{route('second', ['contactlog', 'download'])}}">{{trans('message.download')}}</a>
            </div>
        </div>

    </form>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">STT</th>
        <th scope="col">{{trans('message.contact_id')}}</th>
        <th scope="col">Ip</th>
        <th scope="col">{{trans('message.location')}}</th>
        <th scope="col">{{trans('message.phone_call')}}</th>
        <th scope="col">{{trans('message.description_call')}}</th>
        <th scope="col">{{trans('message.date')}}</th>
      </tr>
    </thead>
    <tbody>
      <?php $stt = 1; ?>
      @foreach ($data as $item)
       <tr>
        <th scope="row">{{ $stt++ }}</th>
           <td>{{$item->Contact->title}} </td>
        <td>{{$item->ip}} </td>
        <td>{{$item->location}} </td>
        <td>{{$item->mobile}} </td>
        <td>{{$item->description}} </td>
        <td>{{$item->created_at}} </td>
      </tr>
      @endforeach
    </tbody>
  </table>
    <span>{!! $data->render() !!}</span>
</div>
@endsection
<script src="{{asset('public/frontend/vendor/jquery/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#paginate").change(function () {
            $("select option:selected").each(function () {
                str = $(this).val();
                $("#paginator").val(str);
                var form = $('#form1');
                //$(document.body).append(form);
                form.submit();
            });
        })
    })
</script>

