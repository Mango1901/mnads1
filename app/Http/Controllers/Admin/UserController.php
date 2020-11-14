<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Users;
use Illuminate\Support\Facades\Auth;
use App\Validations\Validation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public $data;
    private $perPage;
    private $model;
    public function __construct()
    {
        $this->perPage  = config('admin.per_page');
        $this->model    = new Users();
        $this->data['controller'] = __CLASS__;
    }
    public function index(Request $request)
    {
        $requestData=$request->all();
        if(isset($requestData['seach_user'])&&!empty($requestData['seach_user'])){
            $username=$requestData['seach_user'];
            $this->data['data']=$this->model->where('username','like',"%{$username}%")->orwhere('email','like',"%{$username}%")->get();
            return view('user.index', $this->data);
        }
       $this->data['data'] = $this->model->get();
        view('admin_user_layout',$this->data);
       return view('user.index', $this->data);
    }


    public function store( Request $request)
    {
        $requestData = $request->all();
        $validator = Validation::validateSignupRequest($request);

        if ($validator->fails()) {
            return redirect('user/create')
                ->withErrors($validator)
                ->withInput();
        }
        Users::insert(
            array('username'=>$requestData['username'],'password'=>bcrypt($requestData['password']),'email'=>$requestData['email'],'fullname'=>$requestData['fullname'] ,'website'=>$requestData['website'],'token'=>Str::random(60))
        //,'start_time'=>$requestData['start_time'],'active'=>$requestData['active'])
        );

      return redirect('/user/index');
    }
    public function edit(Request $request, $id) {

        $this->data['data'] = $this->model->where('id',$id)->first();

        return view('user.update',$this->data);
    }
    public function update(Request $request){

        $requestData = $request->all();

      $this->model->where('id',$requestData['id'])->update(
            array('email'=>$requestData['email'],'fullname'=>$requestData['fullname'] ,'website'=>$requestData['website'],'active'=>$requestData['active']
            ));

         return redirect('/user/index');
    }
    public function delete(Request $request, $id)
    {
      $this->model->where('id', $id)->delete();

      return redirect('user/index');
    }


    public function profile() {

        $user_id = Auth::user()->id;

        $this->data['data'] = $this->model->where('id',$user_id)->first();

        return view('user.usersetting', $this->data);

    }

    public function updateprofile(Request $request) {

        $requestData = $request->all();

        $user_id = Auth::user()->id;

        $requestData = $request->all();

         request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $path = "";
        if($request->hasFile("image")){
            $path = $request->file('image')->store('/public/avatar');
            $path = str_replace("public", "", $path);
        }

        $this->model->where('id',$user_id)->update(
            array('fullname'=>$requestData['fullname'],'website'=>$requestData['website'], 'company_name'=>$requestData['company_name'],'description'=>$requestData['description'],'avatar' => $path)
        );

         return redirect('dashboard');

    }

    public function showpassword() {
        $user_id = Auth::user()->id;

        $this->data['data'] = $this->model->where('id',$user_id)->first();

        return view('user.changepassword', $this->data);
    }


    public function changepassword(Request $request){

        $requestData = $request->all();

        $validator = Validation::validatechangepasswordRequest($request);

        if ($validator->fails()) {
            return redirect('user/showpassword')
                        ->withErrors($validator)
                        ->withInput();
        }


        $user_id = Auth::user()->id;
        $user = Users::where('id', $user_id)->first();

        $passwordmahoa  = $requestData["oldpassword"];

        if (Hash::check($passwordmahoa, $user->password)) {

            // The passwords match...
            $this->model->where('id',$user_id)->update(
            array('password'=> bcrypt($requestData['password'])
            ));

            return redirect('user/showpassword')->with('status','Change password success!');

        } else{
            return redirect('user/showpassword')->with('status','Old password fails');
        }

        return redirect('dashboard');
    }
    //Logout
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }



}
