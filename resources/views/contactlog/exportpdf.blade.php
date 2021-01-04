<h1 style="text-align: center;color: orange">Cong ty thuong mai co phan phuong dong</h1>
<style type="text/css">
    table {
        border-collapse: collapse;
        word-wrap: break-word;
    }
    tr th{
        word-wrap: break-word;
        margin: 10px 0;
        padding: 10px 0;
    }

    table, th, td {
        border: 1px solid black;
        word-wrap: break-word;
    }
    body,span,table {
        font-family: DejaVu Sans;
        word-wrap: break-word;
    }

</style>
<table border="1"   class="table table-bordered">
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
       <tr style="text-align: center;" >
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
