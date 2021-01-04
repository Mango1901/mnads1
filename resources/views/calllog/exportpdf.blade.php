<h1 style="text-align: center;color: orange ">cong ty thuong mai co phan phuong dong</h1><br/>
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
<table style="font-size: 25px;text-align: center;width: 100%;!important;" class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">{{trans('message.call_name')}}</th>
                <th scope="col">{{trans('message.id_call')}}</th>
                <th scope="col">{{trans('message.location')}}</th>
                <th scope="col">{{trans('message.date')}}</th>
            </tr>
            </thead>

            <tbody>

            <?php $stt=1; ?>
            @foreach ($data as $ca)
                <tr style="text-align: center;">
                    <th >{{ $stt++ }}</th>
                    <td>{{$ca->Call->name}} </td>
                    <td>{{$ca->ip}} </td>
                    <td>{{$ca->location}} </td>
                    <td>{{$ca->created_at}} </td>
                </tr>
            @endforeach
            </tbody>
        </table>
