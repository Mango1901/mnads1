<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Maps;
use Illuminate\Support\Facades\Auth;
use App\Validations\Validation;
class MapsController extends Controller
{
    public $data;
    private $perPage;
    private $model;

    public function __construct()
    {
        $this->perPage  = config('admin.per_page');
        $this->model    = new Maps();
        //
        $this->data['controller'] = __CLASS__;
    }


    public function index()
    {
        $user_id=Auth::id();
       $this->data['data'] = $this->model->where('user_id',$user_id)->get();
       return view('maps.index', $this->data);
    }

    public function create() {

        return view('maps.create');
    }



    public function store( Request $request)
    {
        $requestData = $request->all();
        // $validator=Validation::validatemapRequest($request);
        // if($validator->fails()){
        //     return redirect('maps/create')
        //         ->withErrors($validator)
        //         ->withInput();
        // }
        $user_id=Auth::id();
        $this->model->insert(
            array('user_id'=>$user_id,'map'=>$requestData['map'])
        );
       return redirect('maps/index');
    }


    public function edit(Request $request, $id) {

        $this->data['data'] = $this->model->where('id',$id)->first();

        return view('maps.update',$this->data);
    }


    public function update(Request $request){

        $requestData = $request->all();

        $this->model->where('id',$requestData['id'])->update(
            array('map'=>$requestData['map']
        ));
         return redirect('maps/index');
    }


    public function delete(Request $request, $id){
      $this->model->where('id', $id)->delete();

      return redirect('maps/index');
    }

}
