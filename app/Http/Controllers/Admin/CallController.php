<?php

namespace App\Http\Controllers\Admin;

use App\Repository\CallRepository;
use App\User;
use App\Validations\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Call;

class CallController extends Controller
{
    protected $_CallRepository;

    public function __construct(CallRepository $callRepository)
    {
        $this->_CallRepository = $callRepository;
    }
    public function index() {
        $user_id = Auth::user()->id;
        $get_call =  $this->_CallRepository->getCallUserId($user_id);
        return view('Call.index',compact('get_call'));
    }

    public function create() {

        return view('Call.create');
    }

    public function store( Request $request)
    {
        $validator = Validation::ValidateCallRequest($request);
        if ($validator->fails()) {
            return redirect('call/create')
                ->withErrors($validator)
                ->withInput();
        }
        $requestData = $request->all();
        $user_id = Auth::user()->id;
        if (Auth()->user()->can('create',Call::class)) {
            $check_phone_number_exist = $this->_CallRepository->checkPhoneNumber($user_id,$requestData['phone_number']);
            if($check_phone_number_exist){
                return redirect('call/index')->with('error','This phone number had already been used');
            }
            $this->_CallRepository->CreateCall($user_id,$requestData['name'],$requestData['phone_number'],$requestData['description']);
            return redirect('call/index')->with('message', 'Add call successfully');
        }else{
            return redirect('call/index')->with("error","your account did not have permission to add more calls");
        }
    }

    public function edit(Request $request, $id) {

        $edit_call = $this->_CallRepository->EditCall($id);

        return view('Call.update',compact('edit_call'));
    }


    public function update(Request $request){

        $requestData = $request->all();
        $phone_number = $requestData['phone'];

        $validator = Validation::ValidateCallUpdateRequest($request);
        if ($validator->fails()) {
            return redirect('call/edit/'.$requestData['id'])
                ->withErrors($validator)
                ->withInput();
        }
        $check_phone_number_exist = $this->_CallRepository->checkPhoneNumberUpdate(Auth::user()->id,$phone_number,$requestData['id']);
        if($check_phone_number_exist){
            return redirect('call/index')->with('error','this phone number had already been used');
        }else{
            $this->_CallRepository->updateCall($requestData['id'],$requestData['name'],$requestData['phone'],$requestData['description']);
        }
        return redirect('call/index')->with('message','Edit call successfully');
    }

    public function delete($id){
        $this->_CallRepository->deleteCall($id);

        return redirect('call/index')->with('message','Delete call successfully');
    }


























//    public $data;
//    private $perPage;
//    private $model;
//
//    public function __construct()
//    {
//        $this->perPage  = config('admin.per_page');
//        $this->model    = new Call();
//        //
//        $this->data['controller'] = __CLASS__;
//    }
//    public function index() {
//        $user_id = Auth::user()->id;
//        $this->data['data'] = $this->model->where('user_id',$user_id)->where('status',0)->get();
//        return view('Call.index',$this->data);
//    }
//
//    public function create() {
//
//        return view('Call.create');
//    }
//
//    public function store( Request $request)
//    {
//        $validator = Validation::ValidateCallRequest($request);
//        if ($validator->fails()) {
//            return redirect('call/create')
//                ->withErrors($validator)
//                ->withInput();
//        }
//        $requestData = $request->all();
//        $user_id = Auth::user()->id;
//        if (Auth()->user()->can('create', Call::class)) {
//        $check_phone_number_exist = Call::where('user_id',$user_id)->where('phone_number',$requestData['phone_number'])->first();
//        if($check_phone_number_exist){
//            return redirect('call/index')->with('error','This phone number had already been used');
//        }
//        $this->model->create(
//            array('user_id'=>$user_id,'name'=>$requestData['name'],'phone_number'=>$requestData['phone_number'],'description'=>$requestData['description'])
//        );
//        return redirect('call/index')->with('message', 'Add call successfully');
//        }else{
//            return redirect('call/index')->with("error","your account did not have permission to add more calls");
//        }
//    }
//
//    public function edit(Request $request, $id) {
//
//        $this->data['data'] = $this->model->where('id',$id)->where('status',0)->first();
//
//        return view('Call.update',$this->data);
//    }
//
//
//    public function update(Request $request){
//
//        $requestData = $request->all();
//        $validator = Validation::ValidateCallUpdateRequest($request);
//        if ($validator->fails()) {
//            return redirect('call/edit/'.$requestData['id'])
//                ->withErrors($validator)
//                ->withInput();
//        }
//        $check_phone_number_exist = Call::where('user_id',Auth::user()->id)->where('phone_number',$requestData['phone'])->whereNotIn('id',[$requestData['id']])->first();
//        if($check_phone_number_exist){
//            return redirect('call/index')->with('error','this phone number had already been used');
//        }else{
//            $this->model->where('id',$requestData['id'])->update(
//                array('name'=>$requestData['name'],'phone_number'=>$requestData['phone'],'description'=>$requestData['description']
//            ));
//        }
//         return redirect('call/index')->with('message','Edit call successfully');
//    }
//
//    public function delete(Request $request, $id){
//      $this->model->where('id', $id)->update(['status'=>1]);
//
//      return redirect('call/index')->with('message','Delete call successfully');
//    }


}
