<?php

namespace App\Http\Controllers\Admin;

use App\Repository\ChatZaloRepository;
use Illuminate\Http\Request;
use App\ChatZalo;
use Illuminate\Support\Facades\Auth;
use App\Validations\Validation;
class ChatZaloController extends Controller
{
    protected $_ChatZaloRepository;

    public function __construct(ChatZaloRepository $chatZaloRepository)
    {
        $this->_ChatZaloRepository = $chatZaloRepository;
    }
    public function index()
    {
        $user_id = Auth::user()->id;
       $getChatZalo = $this->_ChatZaloRepository->getChatZaloByUserId($user_id);
       return view('chatzalo.index', compact("getChatZalo"));
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
        if (Auth()->user()->can('create', ChatZalo::class)) {
            $check_zalo_name_exist = $this->_ChatZaloRepository->CheckZaloNameExist($user_id,$requestData['zalo_name']);
            if ($check_zalo_name_exist) {
                return redirect('chatzalo/index')->with('error','this name had already been used');
            }
            $this->_ChatZaloRepository->CreateChatZalo($user_id,$requestData['zalo_name'],$requestData['zalo_title']);
            return redirect('chatzalo/index')->with('message','Add chat Zalo successfully');
        } else {
            return redirect('chatzalo/index')->with("error", "your account did not have permission to add more chats Zalo");
        }
    }


    public function edit(Request $request, $id) {

        $editChatZalo = $this->_ChatZaloRepository->getChatZaloId($id);

        return view('chatzalo.update',compact("editChatZalo"));
    }


    public function update(Request $request){

        $requestData = $request->all();
        $validator = Validation::validatezaloUpdateRequest($request);

        if ($validator->fails()) {
            return redirect('chatzalo/edit/'.$requestData['id'])
                ->withErrors($validator)
                ->withInput();
        }
        $check_zalo_name_exist = $this->_ChatZaloRepository->CheckZaloNameUpdate(Auth::user()->id,$requestData['zalo_name'],$requestData['id']);
        if($check_zalo_name_exist){
            return redirect('chatzalo/index')->with('error','this name had already been used');
        }else{
            $this->_ChatZaloRepository->UpdateChatZalo($requestData['id'],$requestData['zalo_name'],$requestData['zalo_title']);
        }
         return redirect('chatzalo/index')->with('message','Update chat Zalo successfully');
    }
    public function delete(Request $request, $id){
      $this->_ChatZaloRepository->deleteChatZalo($id);

      return redirect('chatzalo/index')->with('message','Delete chat Zalo successfully');
    }






















    //    public $data;
//    private $perPage;
//    private $model;
//
//    public function __construct()
//    {
//        $this->perPage  = config('admin.per_page');
//        $this->model    = new ChatZalo();
//        //
//        $this->data['controller'] = __CLASS__;
//    }
//
//
//    public function index()
//    {
//        $user_id = Auth::user()->id;
//       $this->data['data'] = $this->model->where('user_id',$user_id)->where('status',0)->get();
//       return view('chatzalo.index', $this->data);
//    }
//
//    public function create() {
//        return view('chatzalo.create');
//    }
//
//    public function store( Request $request)
//    {
//        $requestData = $request->all();
//        $validator = Validation::validatezaloRequest($request);
//
//        if ($validator->fails()) {
//            return redirect('chatzalo/create')
//                ->withErrors($validator)
//                ->withInput();
//        }
//        $user_id=Auth::user()->id;
//        if (Auth()->user()->can('create', ChatZalo::class)) {
//            $check_zalo_name_exist = ChatZalo::where('user_id',$user_id)->where('zalo_name',$requestData['zalo_name'])->first();
//            if ($check_zalo_name_exist) {
//                return redirect('chatzalo/index')->with('error','this name had already been used');
//            }
//            $this->model->insert(
//                array('user_id'=>$user_id,'zalo_name'=>$requestData['zalo_name'])
//            );
//            return redirect('chatzalo/index')->with('message','Add chat Zalo successfully');
//        } else {
//            return redirect('chatzalo/index')->with("error", "your account did not have permission to add more chats Zalo");
//        }
//    }
//
//
//    public function edit(Request $request, $id) {
//
//        $this->data['data'] = $this->model->where('id',$id)->where('status',0)->first();
//
//        return view('chatzalo.update',$this->data);
//    }
//
//
//    public function update(Request $request){
//
//        $requestData = $request->all();
//        $validator = Validation::validatezaloUpdateRequest($request);
//
//        if ($validator->fails()) {
//            return redirect('chatzalo/edit/'.$requestData['id'])
//                ->withErrors($validator)
//                ->withInput();
//        }
//        $check_zalo_name_exist = ChatZalo::where('user_id',Auth::user()->id)->where('zalo_name',$requestData['zalo_name'])->whereNotIn('id',[$requestData['id']])->first();
//        if($check_zalo_name_exist){
//            return redirect('chatzalo/index')->with('error','this name had already been used');
//        }else{
//            $this->model->where('id',$requestData['id'])->update(
//                array('zalo_name'=>$requestData['zalo_name']
//            ));
//        }
//         return redirect('chatzalo/index')->with('message','Update chat Zalo successfully');
//    }
//    public function delete(Request $request, $id){
//      $this->model->where('id', $id)->update(['status'=>1]);
//
//      return redirect('chatzalo/index')->with('message','Delete chat Zalo successfully');
//    }


}
