<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\ChatFaceBook;
use Illuminate\Support\Facades\Auth;
use App\Validations\Validation;

class ChatFaceBookController extends Controller
{
    public $data;
    private $perPage;
    private $model;

    public function __construct()
    {
        $this->perPage = config('admin.per_page');
        $this->model = new ChatFaceBook();
        //
        $this->data['controller'] = __CLASS__;
    }


    public function index()
    {
        $user_id = Auth::user()->id;
        $this->data['data'] = $this->model->where('user_id', $user_id)->get();
        return view('chatfacebook.index', $this->data);
    }

    public function create()
    {
        return view('chatfacebook.create');
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        // $validator = Validation::validatefacebookRequest($request);

        // if ($validator->fails()) {
        //     return redirect('chatfacebook/create')
        //         ->withErrors($validator)
        //         ->withInput();
        // }
//        $rule = [
//            'facebookid' => ['required']
//        ];
//        $message = [
//            'facebookid.required' => 'Facebook id không được trống'
//        ];
//        $request->validate($rule,$message);
        $user_id = Auth::user()->id;
        $this->model->insert(
            array('user_id' => $user_id, 'facebook_id' => $requestData['facebookid'])
        );
        return redirect('chatfacebook/index');
    }


    public function edit(Request $request, $id)
    {

        $this->data['data'] = $this->model->where('id', $id)->first();

        return view('chatfacebook.update', $this->data);
    }


    public function update(Request $request)
    {

        $requestData = $request->all();
        $validator = Validation::validatefacebookupdateRequest($request);
        if ($validator->fails()) {
            return redirect('chatfacebook/update')
                ->withErrors($validator)
                ->withInput();
        }
        $this->model->where('id', $requestData['id'])->update(
            array('facebook_id' => $requestData['facebookid']
            ));
        return redirect('chatfacebook/index');
    }


    public function delete(Request $request, $id)
    {
        $this->model->where('id', $id)->delete();
        return redirect('chatfacebook/index');
    }


}
