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

class ChartController extends Controller
{
    private $data;
    private $model;
    public function __construct()
    {
        $this->data['controller']=__CLASS__;
        $this->model=new Chatfblog();
    }
    public function index(){
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $date1 = date("Y-m-d");
        $date2 = date("Y-m-d");
        if(isset($_GET['date1'])){
            $date1 = $_GET['date1'];
        }
        if(isset($_GET['date2'])) {
            $date2 = $_GET['date2'];
        }
        $zalo_log = Chatzalolog::where('user_id',Auth::user()->id)->where('created_at','>=',$date1. ' 00:00:00')->where('created_at','<=',$date2. ' 23:59:59')->count();
        $facebook_log = Chatfblog::where('user_id',Auth::user()->id)->where('created_at','>=',$date1. ' 00:00:00')->where('created_at','<=',$date2. ' 23:59:59')->count();
        $contact_log = Contactlog::where('user_id',Auth::user()->id)->where('created_at','>=',$date1. ' 00:00:00')->where('created_at','<=',$date2. ' 23:59:59')->count();
        $map_log  = Maplog::where('user_id',Auth::user()->id)->where('created_at','>=',$date1. ' 00:00:00')->where('created_at','<=',$date2. ' 23:59:59')->count();
        $call_log = Calllog::where('user_id',Auth::user()->id)->where('created_at','>=',$date1. ' 00:00:00')->where('created_at','<=',$date2. ' 23:59:59')->count();
        $google_report = GoogleReport::where('user_id',Auth::user()->id)->get();
        return view('chart.index',compact('zalo_log','facebook_log','contact_log','map_log','call_log','google_report'));
    }
}
