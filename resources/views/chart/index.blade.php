@extends('admin_layout', ['title' => 'ChatFaceBook'])
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <!-- Content Row -->
        <div class="row">

            <div class="col-xl-12 col-lg-12">

                <!-- Area Chart -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{trans('message.area')}}</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart" style="padding-bottom: 25px"></canvas>
                        </div>
                        <hr>
                        <div class="col-xl-12 col-lg-12" style="display: flex;">
                            <div class="col-xl-2 col-lg-2" style="display: flex">
                                <div class="col-xl-3 col-lg-3"
                                     style="width:30px;height:30px;background:rgba(78, 115, 223, 1);border-radius:5px;"></div>
                                <div class="col-xl-9 col-lg-9"><span>: Zalo Log</span></div>
                            </div>
                            <div class="col-xl-2 col-lg-4" style="display: flex">
                                <div class="col-xl-3 col-lg-3"
                                     style="width:30px;height:30px;background:rgba(255,0,0,1);border-radius:5px;"></div>
                                <div class="col-xl-9 col-lg-9"><span>: Facebook Log</span></div>
                            </div>
                            <div class="col-xl-2 col-lg-4" style="display: flex">
                                <div class="col-xl-3 col-lg-3"
                                     style="width:30px;height:30px;background:rgba(0,255,0,1);border-radius:5px;"></div>
                                <div class="col-xl-9 col-lg-9"><span>: Contact Log</span></div>
                            </div>
                            <div class="col-xl-2 col-lg-4" style="display: flex">
                                <div class="col-xl-3 col-lg-3"
                                     style="width:30px;height:30px;background:rgba(100, 200, 200, 1);border-radius:5px;"></div>
                                <div class="col-xl-9 col-lg-9"><span>: Map Log</span></div>
                            </div>

                            <div class="col-xl-2 col-lg-4" style="display: flex">
                                <div class="col-xl-3 col-lg-3"
                                     style="width:30px;height:30px;background:rgba(10, 0, 0, 1);border-radius:5px;"></div>
                                <div class="col-xl-9 col-lg-9"><span>: Call Log</span></div>
                            </div>

                        </div>
                        <table  class="table table-bordered" style="text-align: center;width: 100%;!important;">
                            <thead>
                            <tr>
                                <th scope="col">Google Ads Impression(30 days)</th>
                                <th scope="col">Google Ads Clicks(30 days)</th>
                                <th scope="col">Zalo Log Clicks</th>
                                <th scope="col">Facebook Log Clicks</th>
                                <th scope="col">Contact Log Clicks</th>
                                <th scope="col">Map Log Clicks</th>
                                <th scope="col">Call Log Clicks</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    @if($google_report->isEmpty())
                                        <td>0</td>
                                        <td>0</td>
                                    @else
                                    @foreach($google_report as $key => $value)
                                        <td>{{$value->impressions_desktop+$value->impressions_mobile+$value->impressions_tablet}}</td>
                                        <td>{{$value->clicks_desktop+$value->clicks_mobile+$value->clicks_tablet}}</td>
                                    @endforeach
                                    @endif
                                    <td>@php echo $zalo_log @endphp</td>
                                    <td>@php echo $facebook_log @endphp</td>
                                    <td>@php echo $contact_log @endphp</td>
                                    <td>@php echo $map_log @endphp</td>
                                    <td>@php echo $call_log @endphp</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Bar Chart -->
            </div>

            <!-- Donut Chart -->
        </div>
        <script src="{{asset('public/frontend/vendor/jquery/jquery.min.js')}}"></script>
        <script>
            $(document).ready(function () {
                function querySt(ji) {

                    hu = window.location.search.substring(1);
                    gy = hu.split("&");
                    for (var i = 0; i < gy.length; i++) {
                        ft = gy[i].split("=");
                        if (ft[0] == ji) {
                            return ft[1];
                        }
                    }
                }
                var date1=querySt('date1');
                var date2=querySt('date2');
                var date='';
                if(typeof date1==='undefined'&&typeof date2==='undefined'){
                    date='';
                }else{
                    date='date1='+date1+'&date2='+date2;
                }
                $.ajax({ //Process the form using $.ajax()
                    type: 'GET', //Method type
                    url: 'http://localhost/mnads/api/chartlog', //Your form processing file URL
                    data: date, //Forms name
                    dataType: 'json',
                    success: function (data) {
                        if (data.status) { //If fails
                            var logzalo = data.data.zalolog;
                            var logcontact = data.data.contactlog;
                            var logmap = data.data.maplog;
                            var logcall = data.data.calllog;
                            var logfb = data.data.fblog;
                            var fbdate = [];
                            var zalodate = [];
                            var calldate = [];
                            var contactdate = [];
                            var mapdate = [];
                            var fbvalue = [];
                            var zalovalue = [];
                            var callvalue = [];
                            var contactvalue = [];
                            var mapvalue = [];
                            var date1=data.data.date1;
                            var date2=data.data.date2;

                            var labeldate=[];
                            if(data.data.date_format=='hours'){
                                labeldate=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24];
                                zalovalue=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
                                fbvalue=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
                                mapvalue=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
                                contactvalue=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
                                callvalue=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
                                for (var i = 0; i <logzalo.length; i++) {
                                    var time=new Date(logzalo[i].created_at);
                                    var a=time.getHours();
                                    for(var j=0;j<a;j++){
                                        if(j==a-1){
                                            zalovalue[j]=logzalo[i].count;
                                            continue;
                                        }
                                    }
                                }
                                for (var i = 0; i <logzalo.length; i++) {
                                    var time=new Date(logfb[i].created_at);
                                    var a=time.getHours();
                                    for(var j=0;j<a;j++){
                                        if(j==a-1){
                                            fbvalue[j]=logfb[i].count;
                                            continue;
                                        }
                                    }
                                }
                                for (var i = 0; i <logmap.length; i++) {
                                    var time=new Date(logmap[i].created_at);
                                    var a=time.getHours();
                                    for(var j=0;j<a;j++){
                                        if(j==a-1){
                                            mapvalue[j]=logmap[i].count;
                                            continue;
                                        }
                                    }
                                }
                                for (var i = 0; i <logcall.length; i++) {
                                    var time=new Date(logcall[i].created_at);
                                    var a=time.getHours();
                                    for(var j=0;j<a;j++){
                                        if(j==a-1){
                                            callvalue[j]=logcall[i].count;
                                            continue;
                                        }
                                    }
                                }
                                for (var i = 0; i <logcontact.length; i++) {
                                    var time=new Date(logcontact[i].created_at);
                                    var a=time.getHours();
                                    for(var j=0;j<a;j++){
                                        if(j==a-1){
                                            contactvalue[j]=logcontact[i].count;
                                            continue;
                                        }
                                    }
                                }
                            }else if(data.data.date_format=='date'){
                                var date1=new Date(data.data.date1);
                                var date2=new Date(data.data.date2);
                                var timedate1=new Date(date1.getTime());
                                var timedate2=new Date(date2.getTime());
                                var numberdate=(timedate2-timedate1)/(24 * 60 * 60 * 1000);
                                for(var i=0;i<=numberdate;i++){
                                    var last1day = new Date(date1.getTime() + (i * 24 * 60 * 60 * 1000));
                                    labeldate[i]=last1day.getDate();
                                }
                                for (var i=0;i<=numberdate;i++){
                                    zalovalue[i]=0;
                                    fbvalue[i]=0;
                                    contactvalue[i]=0;
                                    callvalue[i]=0;
                                    mapvalue[i]=0;

                                }
                                for (var i = 0; i < logzalo.length; i++) {
                                    for(var j=0;j<=numberdate;j++){
                                        var getdate=new Date(logzalo[i].created_at);
                                        var getdate1=getdate.getDate();
                                        if(getdate1==labeldate[j]){
                                            zalovalue[j]=logzalo[i].count;
                                            continue
                                        }
                                    }
                                }
                                for (var i = 0; i < logfb.length; i++) {
                                    for(var j=0;j<=numberdate;j++){
                                        var getdate=new Date(logfb[i].created_at);
                                        var getdate1=getdate.getDate();
                                        if(getdate1==labeldate[j]){
                                            fbvalue[j]=logfb[i].count;
                                            continue
                                        }
                                    }
                                }
                                for (var i = 0; i < logcontact.length; i++) {
                                    for(var j=0;j<=numberdate;j++){
                                        var getdate=new Date(logcontact[i].created_at);
                                        var getdate1=getdate.getDate();
                                        if(getdate1==labeldate[j]){
                                            contactvalue[j]=logcontact[i].count;
                                            continue
                                        }
                                    }
                                }
                                for (var i = 0; i < logcall.length; i++) {
                                    for(var j=0;j<=numberdate;j++){
                                        var getdate=new Date(logcall[i].created_at);
                                        var getdate1=getdate.getDate();
                                        if(getdate1==labeldate[j]){
                                            callvalue[j]=logcall[i].count;
                                            continue
                                        }
                                    }
                                }
                                for (var i = 0; i < logmap.length; i++) {
                                    for(var j=0;j<=numberdate;j++){
                                        var getdate=new Date(logmap[i].created_at);
                                        var getdate1=getdate.getDate();
                                        if(getdate1==labeldate[j]){
                                            mapvalue[j]=logmap[i].count;
                                            continue
                                        }
                                    }
                                }
                            }
                            else {
                                for (var i = 0; i < logzalo.length; i++) {
                                    zalodate[i] = logzalo[i].created_at;
                                    zalovalue[i] = logzalo[i].count;
                                }
                                for (var i = 0; i < logmap.length; i++) {
                                    mapdate[i] = logmap[i].created_at;
                                    mapvalue[i] = logmap[i].count;
                                }
                                for (var i = 0; i < logcall.length; i++) {
                                    calldate[i] = logcall[i].created_at;
                                    callvalue[i] = logcall[i].count;
                                    labeldate[i]=calldate[i];
                                }
                                for (var i = 0; i < logfb.length; i++) {
                                    fbdate[i] = logfb[i].created_at;
                                    fbvalue[i] = logfb[i].count;
                                }
                                for (var i = 0; i < logcontact.length; i++) {
                                    contactdate[i] = logcontact[i].created_at;
                                    contactvalue[i] = logcontact[i].count;
                                }
                            }
                            var ctx = document.getElementById("myAreaChart");
                            var myLineChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: labeldate,
                                    datasets: [{
                                        label: "Zalo",
                                        lineTension: 0.3,
                                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                                        borderColor: "rgba(78, 115, 223, 1)",//xanh
                                        pointRadius: 3,
                                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                                        pointBorderColor: "rgba(78, 115, 223, 1)",
                                        pointHoverRadius: 3,
                                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                                        pointHitRadius: 10,
                                        pointBorderWidth: 2,
                                        data: zalovalue,
                                    },
                                        {
                                        label: "Facebook Log",
                                        lineTension: 0.3,
                                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                                        borderColor: "rgba(255,0,0,1)",//đỏ
                                        pointRadius: 3,
                                        pointBackgroundColor: "rgba(20, 80, 200, 0.05)",
                                        pointBorderColor: "rgba(20, 80, 200, 1)",
                                        pointHoverRadius: 3,
                                        pointHoverBackgroundColor: "rgba(20, 80, 200, 1)",
                                        pointHoverBorderColor: "rgba(20, 80, 200, 1)",
                                        pointHitRadius: 10,
                                        pointBorderWidth: 2,
                                        data: fbvalue,
                                    }, {
                                        label: "Contact",
                                        lineTension: 0.3,
                                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                                        borderColor: "rgba(0,255,0,1)",
                                        pointRadius: 4,
                                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                                        pointBorderColor: "rgba(0, 0, 255, 1)",
                                        pointHoverRadius: 3,
                                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                                        pointHitRadius: 10,
                                        pointBorderWidth: 2,
                                        data: contactvalue,
                                    }, {
                                        label: "Map",
                                        lineTension: 0.3,
                                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                                        borderColor: "rgba(100, 200, 200, 1)",
                                        pointRadius: 3,
                                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                                        pointBorderColor: "rgba(78, 115, 223, 1)",
                                        pointHoverRadius: 3,
                                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                                        pointHitRadius: 10,
                                        pointBorderWidth: 2,
                                        data: mapvalue,
                                    }, {
                                        label: "Calllog",
                                        lineTension: 0.3,
                                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                                        borderColor: "rgba(10, 0, 0, 1)",
                                        pointRadius: 3,
                                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                                        pointBorderColor: "rgba(78, 115, 223, 1)",
                                        pointHoverRadius: 3,
                                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                                        pointHitRadius: 10,
                                        pointBorderWidth: 2,
                                        data: callvalue,
                                    },

                                    ],
                                },
                                options: {
                                    maintainAspectRatio: false,
                                    layout: {
                                        padding: {
                                            left: 10,
                                            right: 25,
                                            top: 25,
                                            bottom: 0
                                        }
                                    },
                                    scales: {
                                        xAxes: [{
                                            time: {
                                                unit: 'date'
                                            },
                                            gridLines: {
                                                display: false,
                                                drawBorder: false
                                            },
                                            ticks: {
                                                maxTicksLimit: 7
                                            }
                                        }],
                                        yAxes: [{
                                            ticks: {
                                                maxTicksLimit: 2,
                                                padding: 10,
                                                // Include a dollar sign in the ticks
                                                callback: function (value, index, values) {
                                                    return number_format(value);
                                                }
                                            },
                                            gridLines: {
                                                color: "rgb(234, 236, 244)",
                                                zeroLineColor: "rgb(234, 236, 244)",
                                                drawBorder: false,
                                                borderDash: [2],
                                                zeroLineBorderDash: [2]
                                            }
                                        }],
                                    },
                                    legend: {
                                        display: false
                                    },
                                    tooltips: {
                                        backgroundColor: "rgb(255,255,255)",
                                        bodyFontColor: "#858796",
                                        titleMarginBottom: 10,
                                        titleFontColor: '#6e707e',
                                        titleFontSize: 14,
                                        borderColor: '#dddfeb',
                                        borderWidth: 1,
                                        xPadding: 15,
                                        yPadding: 15,
                                        displayColors: false,
                                        intersect: false,
                                        mode: 'index',
                                        caretPadding: 10,
                                        callbacks: {
                                            label: function (tooltipItem, chart) {
                                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                                return datasetLabel + ' ' + number_format(tooltipItem.yLabel);
                                            }
                                        }
                                    }
                                }
                            });
                        } else {
                            $('#success').fadeIn(1000).append('<p>' + data.posted + '</p>'); //If successful, than throw a success message
                        }
                    }
                });
            });
        </script>
    </div>
@endsection
