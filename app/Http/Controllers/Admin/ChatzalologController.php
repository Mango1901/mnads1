<?php

namespace App\Http\Controllers\Admin;

use App\Chatfblog;
use App\Chatzalolog;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ChatzalologController extends Controller
{
    private $model;
    private $data;
    private $perPage;

    public function __construct()
    {
        $this->model=new Chatzalolog();
        $this->data['controller']=__CLASS__;
        $this->perPage=config('admin.perpage');
    }

    public function getData($requestData) {

        $user_id=Auth::user()->id;

        if(!empty($requestData['paginator_zalo'])){
            switch ($requestData['paginator_zalo']) {
                case 1:
                    Session::put("paginator_zalo",1);
                    break;
                case 2:
                    Session::put("paginator_zalo",2);
                    break;
                case 3:
                    Session::put("paginator_zalo",3);
                    break;
                case 4:
                    Session::put("paginator_zalo",4);
                    break;
            }
        }
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

        switch (Session::get("paginator_zalo")) {
            case 1:
                if(!empty(Session::get("date1")) && !empty(Session::get("date2"))){
                    if(Session::get("date1")==Session::get("date2")){
                        $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date1"))->orderBy('created_at', 'DESC')->paginate(20);
                    }
                    else{
                        $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at','>=',Session::get("date1"))->whereDate('created_at','<=',Session::get("date2"))->orderBy('created_at', 'DESC')->paginate(20);
                    }
                } else if(!empty(Session::get("date1"))){
                    $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date1"))->orderBy('created_at', 'DESC')->paginate(20);
                } else if(!empty(Session::get("date2"))){
                    $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date2"))->orderBy('created_at', 'DESC')->paginate(20);
                } else{
                    $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',date("Y-m-d"))->orderBy('created_at', 'DESC')->paginate(20);
                }
                break;
            case 2:
                if(!empty(Session::get("date1")) && !empty(Session::get("date2"))){
                    if(Session::get("date1")==Session::get("date2")){
                        $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date1"))->orderBy('created_at', 'DESC')->paginate(30);
                    }
                    else{
                        $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at','>=',Session::get("date1"))->whereDate('created_at','<=',Session::get("date2"))->orderBy('created_at', 'DESC')->paginate(30);
                    }
                } else if(!empty(Session::get("date1"))){
                    $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date1"))->orderBy('created_at', 'DESC')->paginate(30);
                } else if(!empty(Session::get("date2"))){
                    $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date2"))->orderBy('created_at', 'DESC')->paginate(30);
                } else{
                    $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',date("Y-m-d"))->orderBy('created_at', 'DESC')->paginate(30);
                }
                break;
            case 3:
                if(!empty(Session::get("date1")) && !empty(Session::get("date2"))){
                    if(Session::get("date1")==Session::get("date2")){
                        $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date1"))->orderBy('created_at', 'DESC')->paginate(40);
                    }
                    else{
                        $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at','>=',Session::get("date1"))->whereDate('created_at','<=',Session::get("date2"))->orderBy('created_at', 'DESC')->paginate(40);
                    }
                } else if(!empty(Session::get("date1"))){
                    $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date1"))->orderBy('created_at', 'DESC')->paginate(40);
                } else if(!empty(Session::get("date2"))){
                    $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date2"))->orderBy('created_at', 'DESC')->paginate(40);
                } else{
                    $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',date("Y-m-d"))->orderBy('created_at', 'DESC')->paginate(40);
                }
                break;
            case 4:
                if(!empty(Session::get("date1")) && !empty(Session::get("date2"))){
                    if(Session::get("date1")==Session::get("date2")){
                        $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date1"))->orderBy('created_at', 'DESC')->paginate(50);
                    }
                    else{
                        $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at','>=',Session::get("date1"))->whereDate('created_at','<=',Session::get("date2"))->orderBy('created_at', 'DESC')->paginate(50);
                    }
                } else if(!empty(Session::get("date1"))){
                    $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date1"))->orderBy('created_at', 'DESC')->paginate(50);
                } else if(!empty(Session::get("date2"))){
                    $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date2"))->orderBy('created_at', 'DESC')->paginate(50);
                } else{
                    $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',date("Y-m-d"))->orderBy('created_at', 'DESC')->paginate(50);
                }
                break;
            default:
                if(!empty(Session::get("date1")) && !empty(Session::get("date2"))){
                    if(Session::get("date1")==Session::get("date2")){
                        $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date1"))->orderBy('created_at', 'DESC')->paginate(20);
                    }
                    else{
                        $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at','>=',Session::get("date1"))->whereDate('created_at','<=',Session::get("date2"))->orderBy('created_at', 'DESC')->paginate(20);
                    }
                } else if(!empty(Session::get("date1"))){
                    $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date1"))->orderBy('created_at', 'DESC')->paginate(20);
                } else if(!empty(Session::get("date2"))){
                    $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date2"))->orderBy('created_at', 'DESC')->paginate(20);
                } else{
                    $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',date("Y-m-d"))->orderBy('created_at', 'DESC')->paginate(20);
                }
        }
        return  $this->data;
    }

    public function index(Request $request){

        $requestData=$request->all();
        $this->data = $this->getData($requestData);


        if (isset($request->submitbutton)) {

            $pdf = PDF::loadView('chatzalolog/exportpdf' , $this->data);
            return $pdf->stream('serial_codes.pdf');

        } else {

            return view('chatzalolog.index',$this->data);
        }
    }
    public function index_ajax(Request $request)
    {
        $requestData = $request->all();
        $user_id=Auth::user()->id;

        if(!empty($requestData['paginator_zalo'])){
            switch ($requestData['paginator_zalo']) {
                case 1:
                    Session::put("paginator_zalo",1);
                    break;
                case 2:
                    Session::put("paginator_zalo",2);
                    break;
                case 3:
                    Session::put("paginator_zalo",3);
                    break;
                case 4:
                    Session::put("paginator_zalo",4);
                    break;
            }
        }

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

        if(isset($requestData['date1']) && isset($requestData['date2'])){
            if($requestData['date1']==$requestData['date2']){
                Session::put("date1",$requestData['date1']);
                Session::put("date2",$requestData['date2']);
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


        switch (Session::get("paginator_zalo")) {
            case 1:
                if(!empty(Session::get("date1")) && !empty(Session::get("date2"))){
                    if(Session::get("date1")==Session::get("date2")){
                        $data1=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date1"))->orderBy('created_at', 'DESC')->paginate(20);
                    } else{
                        $data1=$this->model->where('user_id',$user_id)->whereDate('created_at','>=',Session::get("date1"))->whereDate('created_at','<=',Session::get("date2"))->orderBy('created_at', 'DESC')->paginate(20);
                    }
                } else if(!empty(Session::get("date1"))){
                    $data1=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date1"))->orderBy('created_at', 'DESC')->paginate(20);
                } else if(!empty(Session::get("date2"))){
                    $data1=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date2"))->orderBy('created_at', 'DESC')->paginate(20);
                } else{
                    $data1=$this->model->where('user_id',$user_id)->whereDate('created_at',date("Y-m-d"))->orderBy('created_at', 'DESC')->paginate(20);
                }
                break;
            case 2:
                if(!empty(Session::get("date1")) && !empty(Session::get("date2"))){
                    if(Session::get("date1")==Session::get("date2")){
                        $data1=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date1"))->orderBy('created_at', 'DESC')->paginate(30);
                    }
                    else{
                        $data1=$this->model->where('user_id',$user_id)->whereDate('created_at','>=',Session::get("date1"))->whereDate('created_at','<=',Session::get("date2"))->orderBy('created_at', 'DESC')->paginate(30);
                    }
                } else if(!empty(Session::get("date1"))){
                    $data1=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date1"))->orderBy('created_at', 'DESC')->paginate(30);
                } else if(!empty(Session::get("date2"))){
                    $data1=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date2"))->orderBy('created_at', 'DESC')->paginate(30);
                } else{
                    $data1=$this->model->where('user_id',$user_id)->whereDate('created_at',date("Y-m-d"))->orderBy('created_at', 'DESC')->paginate(30);
                }
                break;
            case 3:
                if(!empty(Session::get("date1")) && !empty(Session::get("date2"))){
                    if(Session::get("date1")==Session::get("date2")){
                        $data1=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date1"))->orderBy('created_at', 'DESC')->paginate(40);
                    }
                    else{
                        $data1=$this->model->where('user_id',$user_id)->whereDate('created_at','>=',Session::get("date1"))->whereDate('created_at','<=',Session::get("date2"))->orderBy('created_at', 'DESC')->paginate(40);
                    }
                } else if(!empty(Session::get("date1"))){
                    $data1=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date1"))->orderBy('created_at', 'DESC')->paginate(40);
                } else if(!empty(Session::get("date2"))){
                    $data1=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date2"))->orderBy('created_at', 'DESC')->paginate(40);
                } else{
                    $data1=$this->model->where('user_id',$user_id)->whereDate('created_at',date("Y-m-d"))->orderBy('created_at', 'DESC')->paginate(40);
                }
                break;
            case 4:
                if(!empty(Session::get("date1")) && !empty(Session::get("date2"))){
                    if(Session::get("date1")==Session::get("date2")){
                        $data1=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date1"))->orderBy('created_at', 'DESC')->paginate(50);
                    }
                    else{
                        $data1=$this->model->where('user_id',$user_id)->whereDate('created_at','>=',Session::get("date1"))->whereDate('created_at','<=',Session::get("date2"))->orderBy('created_at', 'DESC')->paginate(50);
                    }
                } else if(!empty(Session::get("date1"))){
                    $data1=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date1"))->orderBy('created_at', 'DESC')->paginate(50);
                } else if(!empty(Session::get("date2"))){
                    $data1=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date2"))->orderBy('created_at', 'DESC')->paginate(50);
                } else{
                    $data1=$this->model->where('user_id',$user_id)->whereDate('created_at',date("Y-m-d"))->orderBy('created_at', 'DESC')->paginate(50);
                }
                break;
            default:
                if(!empty(Session::get("date1")) && !empty(Session::get("date2"))){
                    if(Session::get("date1")==Session::get("date2")){
                        $data1=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date1"))->orderBy('created_at', 'DESC')->paginate(20);
                    }
                    else{
                        $data1=$this->model->where('user_id',$user_id)->whereDate('created_at','>=',Session::get("date1"))->whereDate('created_at','<=',Session::get("date2"))->orderBy('created_at', 'DESC')->paginate(20);
                    }
                } else if(!empty(Session::get("date1"))){
                    $data1=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date1"))->orderBy('created_at', 'DESC')->paginate(20);
                } else if(!empty(Session::get("date2"))){
                    $data1=$this->model->where('user_id',$user_id)->whereDate('created_at',Session::get("date2"))->orderBy('created_at', 'DESC')->paginate(20);
                } else{
                    $data1=$this->model->where('user_id',$user_id)->whereDate('created_at',date("Y-m-d"))->orderBy('created_at', 'DESC')->paginate(20);
                }
        }
        if($request->ajax()){
            $stt = 1;
            $output ="";
            foreach ($data1 as $key => $item){
                $output .=
                    '<tr>'.
                    '<th scope="row">'.$stt++.'</th>'.
                    '<td>'.$item->ChatZalo->zalo_title. '</td>'.
                    '<td>'.$item->ip .'</td>'.
                    '<td>'.$item->location.'</td>'.
                    '<td>'.$item->created_at.'</td>'.
                    '</tr>';
            }

            $output = $output. $data1 ->render();
            echo "<div style='display: none'></div>";
            echo($output);
        }
    }
}
