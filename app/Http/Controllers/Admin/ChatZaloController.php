<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\ChatZalo;
use Illuminate\Support\Facades\Auth;
use App\Validations\Validation;
class ChatZaloController extends Controller
{
    public $data;
    private $perPage;
    private $model;

    public function __construct()
    {
        $this->perPage  = config('admin.per_page');
        $this->model    = new ChatZalo();
        //
        $this->data['controller'] = __CLASS__;
    }


    public function index()
    {
        $user_id = Auth::user()->id;
       $this->data['data'] = $this->model->where('user_id',$user_id)->get();
       return view('chatzalo.index', $this->data);
    }

    public function create() {
        return view('chatzalo.create');
    }

    public function store( Request $request)
    {
        $requestData = $request->all();
        $validator = Validation::validatezaloRequest($request);

        if ($validator->fails()) {
            return redirect('chatzalo/create')
                ->withErrors($validator)
                ->withInput();
        }
        $user_id=Auth::user()->id;
        $this->model->insert(
            array('user_id'=>$user_id,'zalo_name'=>$requestData['zalo_name'])
        );
       return redirect('chatzalo/index');
    }


    public function edit(Request $request, $id) {

        $this->data['data'] = $this->model->where('id',$id)->first();

        return view('chatzalo.update',$this->data);
    }


    public function update(Request $request){

        $requestData = $request->all();
        $this->model->where('id',$requestData['id'])->update(
            array('zalo_name'=>$requestData['zalo_name']
        ));
         return redirect('chatzalo/index');
    }

    public function delete(Request $request, $id){
      $this->model->where('id', $id)->delete();

      return redirect('chatzalo/index');
    }


}
