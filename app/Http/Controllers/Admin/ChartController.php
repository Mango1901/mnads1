<?php

namespace App\Http\Controllers\Admin;

use App\Calllog;
use App\Chatfblog;
use App\Contactlog;
use App\GoogleReport;
use App\Maplog;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Chatzalolog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ChartController extends Controller
{
    private $data;
    private $model;
    public function __construct()
    {
        $this->data['controller']=__CLASS__;
        $this->model=new Chatfblog();
    }
    public function index(Request $request){
        $requestData = $request->all();
        if(!empty($requestData['selectdate'])) {
            switch ($requestData['selectdate']) {
                case 1:
                    Session::put("selectdate", 1);
                    break;
                case 2:
                    Session::put("selectdate", 2);
                    break;
                case 3:
                    Session::put("selectdate", 3);
                    break;
                case 4:
                    Session::put("selectdate", 4);
                    break;
                case 5:
                    Session::put("selectdate", 5);
                    break;
                case 6:
                    Session::put("selectdate", 6);
                    break;
                case 7:
                    Session::put("selectdate", 7);
                    break;
                case 8:
                    Session::put("selectdate", 8);
                    break;
                case 9:
                    Session::put("selectdate", 9);
                    break;
            }
        }
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        if(isset($requestData['date1']) && isset($requestData['date2'])){
            if($requestData['date1']==$requestData['date2']){
                Session::put("date1",$requestData['date1']);
            }
            else{
                Session::put("date1",$requestData['date1']);
                Session::put("date2",$requestData['date2']);
            }
        } else if(isset($requestData['date1'])){
            Session::put("date1",$requestData['date1']);
        } elseif (isset($requestData['date2'])){
            Session::put("date2",$requestData['date2']);
        }
        $date1 = date("2020-12-09");
        $date2 = date("Y-m-d");
        if(!empty(Session::get("date1"))){
            $date1 = Session::Get("date1");
        }
        if(!empty(Session::get("date2"))){
            $date2 = Session::Get("date2");
        }

        $zalo_log = Chatzalolog::where('user_id',Auth::user()->id)->where('status',0)->where('created_at','>=',$date1. ' 00:00:00')->where('created_at','<=',$date2. ' 23:59:59')->count();
        $facebook_log = Chatfblog::where('user_id',Auth::user()->id)->where('status',0)->where('created_at','>=',$date1. ' 00:00:00')->where('created_at','<=',$date2. ' 23:59:59')->count();
        $contact_log = Contactlog::where('user_id',Auth::user()->id)->where('status',0)->where('created_at','>=',$date1. ' 00:00:00')->where('created_at','<=',$date2. ' 23:59:59')->count();
        $map_log  = Maplog::where('user_id',Auth::user()->id)->where('status',0)->where('created_at','>=',$date1. ' 00:00:00')->where('created_at','<=',$date2. ' 23:59:59')->count();
        $call_log = Calllog::where('user_id',Auth::user()->id)->where('status',0)->where('created_at','>=',$date1. ' 00:00:00')->where('created_at','<=',$date2. ' 23:59:59')->count();
        $google_report = GoogleReport::where('user_id',Auth::user()->id)->where('status',0)->get();
        return view('chart.index',compact('zalo_log','facebook_log','contact_log','map_log','call_log','google_report'));
    }
}
