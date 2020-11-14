@extends('admin_layout', ['title' => 'User'])
@section('content')
    <div class="row">
        <div class="col-sm-4">
            <a href="{{route('get.campaign.details')}}" class=" btn btn-success waves-effect waves-success mb-3"><i class="fas fa-plus-square"></i> {{trans('message.getReport')}} </a>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Clicks</th>
                <th scope="col">Cost</th>
                <th scope="col">Ctr</th>
                <th scope="col">Average Cost</th>
                <th scope="col">Impression</th>
                <th scope="col">Segments</th>
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
                    <td>NULL</td>
                    <td>{{$value->impressions_tablet}}</td>
                    <td>{{$value->segments_tablet}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

