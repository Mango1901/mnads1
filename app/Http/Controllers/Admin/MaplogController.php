<?php

namespace App\Http\Controllers\Admin;

use App\Maplog;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaplogController extends Controller
{
    
    private $model;
    private $data;
    private $perPage;

    public function __construct()
    {
        $this->model=new Maplog();
        $this->data['controller']=__CLASS__;
        $this->perPage=config('admin.perpage');
    }

    public function getData($requestData) {

        $user_id=Auth::id();

        if(isset($requestData['date1'])||isset($requestData['date2'])){
            if($requestData['date1']==$requestData['date2']){
                $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at',$requestData['date2'])->orderBy('created_at', 'DESC')->paginate(20);
                
            }
            else{
                $this->data['data']=$this->model->where('user_id',$user_id)->whereDate('created_at','>=',$requestData['date1'])->whereDate('created_at','<=',$requestData['date2'])->orderBy('created_at', 'DESC')->paginate(20);
             }

            return $this->data;
        }
        if(isset($requestData['paginator'])){
            if($requestData['paginator']=="1"){
                $this->data['data']=$this->model->where('user_id',$user_id)->orderBy('created_at', 'DESC')->paginate(20);
                $this->data['paginator']=1;
               
            }elseif ($requestData['paginator']=="2"){
                $this->data['data']=$this->model->where('user_id',$user_id)->orderBy('created_at', 'DESC')->paginate(30);
                $this->data['paginator']=2;
                
            }
            elseif ($requestData['paginator']=="3"){
                $this->data['data']=$this->model->where('user_id',$user_id)->orderBy('created_at', 'DESC')->paginate(40);
                $this->data['paginator']=3;
                
            }
            elseif ($requestData['paginator']=="4"){
                $this->data['data']=$this->model->where('user_id',$user_id)->orderBy('created_at', 'DESC')->paginate(50);
                $this->data['paginator']=4;
                
            }

            return $this->data;
        }


        $this->data['data']=$this->model->where('user_id',$user_id)->orderBy('created_at', 'DESC')->paginate(20);

        return $this->data;

    }

    public function index(Request $request){

        $requestData=$request->all();
        $this->data = $this->getData($requestData);

        if (isset($request->submitbutton)) {

            $pdf = PDF::loadView('maplog/exportpdf' , $this->data);
            return $pdf->stream('serial_codes.pdf');

        } else {
            
            return view('maplog.index',$this->data);
        }

    }
}
