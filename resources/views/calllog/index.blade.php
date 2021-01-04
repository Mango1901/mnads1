@extends('admin_layout', ['title' => 'Calllog'])
@section('content')
            <div class="row container pagination" >
                @if (session('error'))
                    <div class="alert alert-danger help-block">{{session('error')}}</div>
                @endif
                <form id="form1" action="{{route("calllog.index")}}" method="get" class="form-group">
                    @csrf
                    <div class="col-md-12" style="display: flex">
                        <div class="col-md-6">
                            <select id="paginate" class="form-control">
                                <option {{(Session::get('paginator_call') == 1) ?  'selected':''}} value="1">20</option>
                                <option {{(Session::get('paginator_call') == 2) ?  'selected':''}} value="2">30</option>
                                <option {{(Session::get('paginator_call') == 3) ?  'selected':''}} value="3">40</option>
                                <option {{(Session::get('paginator_call') == 4) ?  'selected':''}} value="4">50</option>
                            </select>
                            <input id="paginator_call" type="hidden" name="paginator_call" value="">
                        </div>
{{--                                            <div class="col-md-6">--}}
{{--                                                <a class="btn btn-primary" href="{{route('second', ['calllog', 'download'])}}">{{trans('message.download')}}</a>--}}
{{--                                            </div>--}}
                    </div>
                </form>
                    <table class="table table-bordered" style="text-align: center;width: 100%;!important;">
                        <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">{{__('call_name')}}</th>
                            <th scope="col">{{__('id_call')}}</th>
                            <th scope="col">{{trans('message.location')}}</th>
                            <th scope="col">{{trans('message.date')}}</th>
                        </tr>
                        </thead>
                        <tbody id="load_call">
                        <?php $stt = 1; ?>
                        @foreach ($data as $item)
                            <tr>
                                <th scope="row">{{ $stt++ }}</th>
                                <td>{{$item->Call->name}} </td>
                                <td>{{$item->ip}} </td>
                                <td>{{$item->location}} </td>
                                <td>{{$item->created_at}} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                        <div id="hidden-pagination">
                          <span>{!! $data->render() !!}</span>
                        </div>
</div>
@endsection
<script src="{{asset('public/frontend/vendor/jquery/jquery.min.js')}}"></script>
<script>
$(document).ready(function() {
    $("#paginate").change(function() {
        $("select option:selected").each(function() {
             var paginator_call = $("#paginate").val();
             var _token = $('input[name="_token"]').val();

            $.ajax({
                type: 'GET',
                cache: false,
                url: "{{route('calllog.index.ajax') }}",
                data: {
                    "_token": _token,
                    "paginator_call":paginator_call,
                },
                success: function (data) {
                    console.log(data['data']);
                    $("#load_call").html(data);

                },
                error: function (data) {
                    console.log('An error occurred.');
                    console.log(data);
                }
            });
            // str = $(this).val();
            // $("#paginator_call").val(str);
            // var form = $('#form1');
            // //$(document.body).append(form);
            // form.submit();
        });
    });

})
</script>
<script>
    $(document).ready(function() {

    });
</script>
<script>
    $(document).ready(function() {

        $(document).on('click', '.pagination a', function(e){
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page)
        {
            $.ajax({
                type: "GET",
                url: 'calllog/index-ajax?page=' + page,
                success: function (data) {
                    $('#load_call').html(data);
                    $('#hidden-pagination').hide(data);
                }
            });

        }
    });
</script>
<style type="text/css">
    #paginate {
        width: 150px;
    }
    .pagination{
        margin-block-end: 0;
        margin-inline-start: 0;
        margin-inline-end: 0;
        padding-inline-start: 0;
        margin-block-start: 0;
        width: 75px ;
    }
</style>
