<h1 style="text-align: center;color: orange">Cong ty thuong mai co phan phuong dong</h1>
<style type="text/css">
  table {
  border-collapse: collapse;
}
table, th, td {
  border: 1px solid black;
}
  body,span,table {
      font-family: DejaVu Sans;
  }
</style>
<table border="1" style="font-size: 25px;width:700px;" class="table table-bordered">
    <thead>
      <tr >
        <th scope="col">STT</th>
        <th scope="col">Zalo name</th>
        <th scope="col">Ip</th>
        <th scope="col">{{trans('message.location')}}</th>
        <th scope="col">{{trans('message.date')}}</th>
      </tr>
    </thead>
    <tbody>
      <?php $stt = 1; ?>
      @foreach ($data as $item)
       <tr style="text-align: center;">
        <th scope="row">{{ $stt++ }}</th>
        <td>{{$item->ChatZalo->zalo_name}} </td>
        <td>{{$item->ip}} </td>
        <td>{{$item->location}} </td>
        <td>{{$item->created_at}} </td>
      </tr>
      @endforeach
    </tbody>
</table>
