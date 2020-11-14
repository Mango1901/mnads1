<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Call;

class CallController extends Controller
{
    public $data;
    private $perPage;
    private $model;

    public function __construct()
    {
        $this->perPage  = config('admin.per_page');
        $this->model    = new Call();
        //
        $this->data['controller'] = __CLASS__;
    }

    public function index() {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $date1 = date("Y-m-d");
        $date2 = date("Y-m-d");
        if(isset($_GET['date1'])){
            $date1 = $_GET['date1'];
        }
        if(isset($_GET['date2'])) {
            $date2 = $_GET['date2'];
        }
        $user_id = Auth::user()->id;
        $this->data['data'] = $this->model->where('user_id',$user_id)->where('created_at','>=',$date1. ' 00:00:00')->where('created_at','<=',$date2. ' 23:59:59')->get();
        return view('Call.index',$this->data);
    }

    public function create() {

        return view('Call.create');
    }

    public function store( Request $request)
    {

        // $this->validate(request(),[
        //     'name'=>'required|min:1|max:20',
        //     'phone_number'=>'required|min:9',
        //     'description'=>'required|min:1'

        // ]);
        $requestData = $request->all();
        $user_id = Auth::user()->id;

        $this->model->insert(
            array('user_id'=>$user_id,'name'=>$requestData['name'],'phone_number'=>$requestData['phone_number'],'description'=>$requestData['description'])
        );
       return redirect('call/index');
    }

    public function edit(Request $request, $id) {

        $this->data['data'] = $this->model->where('id',$id)->first();

        return view('Call.update',$this->data);
    }


    public function update(Request $request){

        $requestData = $request->all();
        $this->model->where('id',$requestData['id'])->update(
            array('name'=>$requestData['name'],'phone_number'=>$requestData['phone'],'description'=>$requestData['description']
        ));

         return redirect('call/index');
    }

    public function delete(Request $request, $id){
      $this->model->where('id', $id)->delete();

      return redirect('call/index');
    }


}
