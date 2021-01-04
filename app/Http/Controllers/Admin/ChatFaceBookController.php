<?php

namespace App\Http\Controllers\Admin;

use App\Repository\ChatFaceBookRepository;
use Illuminate\Http\Request;
use App\ChatFaceBook;
use Illuminate\Support\Facades\Auth;
use App\Validations\Validation;

class ChatFaceBookController extends Controller
{
    protected $_ChatFaceBookRepository;

    public function __construct(ChatFaceBookRepository $chatFaceBookRepository)
    {
        $this->_ChatFaceBookRepository = $chatFaceBookRepository;
    }
    public function index()
    {
        $user_id = Auth::user()->id;
        $getChatFaceBookByUser = $this->_ChatFaceBookRepository->getFaceBookByUserId($user_id);
        return view('chatfacebook.index', compact('getChatFaceBookByUser'));
    }

    public function create()
    {
        return view('chatfacebook.create');
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        $validator = Validation::validatefacebookRequest($request);

        if ($validator->fails()) {
            return redirect('chatfacebook/create')
                ->withErrors($validator)
                ->withInput();
        }
        $user_id = Auth::user()->id;
        if (Auth()->user()->can('create', ChatFaceBook::class)) {
            $check_facebook_id_name = $this->_ChatFaceBookRepository->CheckFaceBookIdName($user_id,$requestData['facebookid']);
            if ($check_facebook_id_name) {
                return redirect('chatfacebook/index')->with('error', 'this facebookId had already been used');
            }
            $this->_ChatFaceBookRepository->createChatFaceBook($user_id,$requestData['facebookid'],$requestData['facebook_title']);
            return redirect('chatfacebook/index')->with('message', 'Add Chat FaceBook successfully');
        } else {
            return redirect('chatfacebook/index')->with("error", "your account did not have permission to add more chats FB");
        }
    }

    public function edit(Request $request, $id)
    {

        $editChatFaceBook = $this->_ChatFaceBookRepository->getChatFaceBookId($id);

        return view('chatfacebook.update', compact("editChatFaceBook"));
    }


    public function update(Request $request)
    {

        $requestData = $request->all();
        $validator = Validation::validatefacebookupdateRequest($request);
        if ($validator->fails()) {
            return redirect('chatfacebook/edit/'.$requestData['id'])
                ->withErrors($validator)
                ->withInput();
        }
        $user_id = Auth::user()->id;
        $check_facebook_id_name = $this->_ChatFaceBookRepository->CheckFaceBookIdNameUpdate($user_id,$requestData['facebookid'],$requestData['id']);
        if($check_facebook_id_name){
         return redirect('chatfacebook/index')->with('error','this facebookId had already been used');
        }else{
        $this->_ChatFaceBookRepository->ChatFaceBookUpdate($requestData['id'],$requestData['facebookid'],$requestData['facebook_title']);
        }
        return redirect('chatfacebook/index')->with('message','update chat facebook successfully');
    }


    public function delete(Request $request, $id)
    {
        $this->_ChatFaceBookRepository->DeleteChatFaceBook($id);
        return redirect('chatfacebook/index')->with('message','delete facebook successfully');
    }


















    //    public $data;
//    private $perPage;
//    private $model;
//
//    public function __construct()
//    {
//        $this->perPage = config('admin.per_page');
//        $this->model = new ChatFaceBook();
//        //
//        $this->data['controller'] = __CLASS__;
//    }
//
//
//    public function index()
//    {
//        $user_id = Auth::user()->id;
//        $this->data['data'] = $this->model->where('user_id', $user_id)->where('status',0)->get();
//        return view('chatfacebook.index', $this->data);
//    }
//
//    public function create()
//    {
//        return view('chatfacebook.create');
//    }
//
//    public function store(Request $request)
//    {
//        $requestData = $request->all();
//
//        $validator = Validation::validatefacebookRequest($request);
//
//        if ($validator->fails()) {
//            return redirect('chatfacebook/create')
//                ->withErrors($validator)
//                ->withInput();
//        }
//        $user_id = Auth::user()->id;
//        if (Auth()->user()->can('create', ChatFaceBook::class)) {
//            $check_facebook_id_name = ChatFaceBook::where('user_id', $user_id)->where('facebook_id', $requestData['facebookid'])->first();
//            if ($check_facebook_id_name) {
//                return redirect('chatfacebook/index')->with('error', 'this facebookId had already been used');
//            }
//            $this->model->insert(
//                array('user_id' => $user_id, 'facebook_id' => $requestData['facebookid'])
//            );
//            return redirect('chatfacebook/index')->with('message', 'Add Chat FaceBook successfully');
//        } else {
//            return redirect('chatfacebook/index')->with("error", "your account did not have permission to add more chats FB");
//        }
//    }
//
//
//    public function edit(Request $request, $id)
//    {
//
//        $this->data['data'] = $this->model->where('id', $id)->where('status',0)->first();
//
//        return view('chatfacebook.update', $this->data);
//    }
//
//
//    public function update(Request $request)
//    {
//
//        $requestData = $request->all();
//        $validator = Validation::validatefacebookupdateRequest($request);
//        if ($validator->fails()) {
//            return redirect('chatfacebook/edit/'.$requestData['id'])
//                ->withErrors($validator)
//                ->withInput();
//        }
//        $user_id = Auth::user()->id;
//        $check_facebook_id_name = ChatFaceBook::where('user_id',$user_id)->where('facebook_id',$requestData['facebookid'])->whereNotIn('id',[$requestData['id']])->first();
//        if($check_facebook_id_name){
//         return redirect('chatfacebook/index')->with('error','this facebookId had already been used');
//        }else{
//        $this->model->where('id', $requestData['id'])->update(
//            array('facebook_id' => $requestData['facebookid']
//            ));
//        }
//        return redirect('chatfacebook/index')->with('message','update chat facebook successfully');
//    }
//
//
//    public function delete(Request $request, $id)
//    {
//        $this->model->where('id', $id)->update(['status'=>1]);
//        return redirect('chatfacebook/index')->with('message','delete facebook successfully');
//    }


}
