@extends('admin_layout', ['title' => 'User'])
@section('content')

    <div class="row">
        <div class="col-sm-4">
            <td><a href="{{route('googleAds.get.campaign.details')}}" class=" btn btn-success waves-effect waves-success mb-3"><i class="fas fa-plus-square"></i> {{trans('message.getReport')}} </a></td>
            <td><a href="{{route('googleAds.delete.google.report')}}" data-toggle="tooltip" title="" class="btn btn-xs btn-danger delete-confirm" data-original-title="Delete" onclick="return confirm('Are you want to google report and change your gmail?')"><i class="fas fa-trash-alt"></i></a> </td>
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
                <th scope="col">{{trans('message.clicks')}}</th>
                <th scope="col">{{trans('message.cost')}}</th>
                <th scope="col">{{trans('message.ctr')}}</th>
                <th scope="col">{{trans('message.averageCpc')}}</th>
                <th scope="col">{{trans('message.Impression')}}</th>
                <th scope="col">{{trans('message.segments')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($google_reports as $key => $value)
                <tr>
                    <td>{{$value->clicks_desktop}}</td>
                    <td>{{($value->cost_desktop)/1000000}} VNĐ</td>
                    <td>{{($value->ctr_desktop)*100}} %</td>
                    <td>{{($value->averageCpc_desktop)/1000000}} VNĐ</td>
                    <td>{{$value->impressions_desktop}}</td>
                    <td>{{$value->segments_desktop}}</td>
                </tr>
                <tr>
                    <td>{{$value->clicks_mobile}}</td>
                    <td>{{($value->cost_mobile)/1000000}} VNĐ</td>
                    <td>{{($value->ctr_mobile)*100}} %</td>
                    <td>{{($value->averageCpc_mobile)/1000000}} VNĐ</td>
                    <td>{{$value->impressions_mobile}}</td>
                    <td>{{$value->segments_mobile}}</td>
                </tr>
                <tr>
                    <td>{{$value->clicks_tablet}}</td>
                    <td>{{($value->cost_tablet)/1000000}} VNĐ</td>
                    <td>{{($value->ctr_tablet*100)}} %</td>
                    <td>{{($value->averageCpc_tablet)/1000000}} VNĐ</td>
                    <td>{{$value->impressions_tablet}}</td>
                    <td>{{$value->segments_tablet}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
