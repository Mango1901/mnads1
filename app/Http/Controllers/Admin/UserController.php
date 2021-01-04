<?php

namespace App\Http\Controllers\Admin;

use App\GoogleLogin;
use App\Repository\UserRepository;
use App\Social;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Validations\Validation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    protected $_userRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     */

    public function __construct(UserRepository $userRepository)
    {
        $this->_userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if(Gate::allows('is-admin')){
            $requestData=$request->all();
            if(isset($requestData['search_user'])&&!empty($requestData['search_user'])){
                $information=$requestData['search_user'];
                $getUser =  $this->_userRepository->getUserInformation($information);
                return view('user.index', compact('getUser'));
            }
            $getUser = $this->_userRepository->getAllUser();
            view('admin_user_layout',compact('getUser'));
            return view('user.index', compact('getUser'));
        }else{
            return redirect('dashboard')->with('error','You dont have permission to sign in');
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view("user.create");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store( Request $request)
    {
        $requestData = $request->all();
        Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });
        $validator = Validation::validateSignupRequest($request);
        if ($validator->fails()) {
            return redirect('user/create')
                ->withErrors($validator)
                ->withInput();
        }
        $check_users_email = $this->_userRepository->CheckEmail($requestData['email']);
        $check_users_name = $this->_userRepository->CheckUserName($requestData['username']);
        if ($check_users_email) {
            return redirect('user/create')->with('error', 'This email had already been used');
        }
        if ($check_users_name) {
            return redirect('user/create')->with('error', 'This username had already been used');
        }
        if(isset($requestData['active'])){
            $requestData['active'] = 1;
        }else{
            $requestData['active'] = 0;
        }
        $this->_userRepository->CreateUserAdmin($requestData['username'],$requestData['password'],$requestData['email'],$requestData['fullname'],$requestData['website'],$requestData['active']);
        return redirect('/user/index')->with('message','Add user information successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {

        $edit = $this->_userRepository->getById($id);

        return view('user.update',compact('edit'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request){

        $requestData = $request->all();
        Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });
        $validator = Validation::validateUpdateRequest($request);
        $check_users_email = $this->_userRepository->CheckEmailUpdate($requestData['id'],$requestData['email']);
        $check_users_name = $this->_userRepository->CheckUsernameUpdate($requestData['id'],$requestData['username']);
        if ($check_users_email) {
            return redirect('user/edit'.$requestData['id'])->with('error', 'This email had already been used');
        }
        if ($check_users_name) {
            return redirect('user/edit'.$requestData['id'])->with('error', 'This username had already been used');
        }
        if ($validator->fails()) {
            return redirect('user/index')
                ->withErrors($validator)
                ->withInput();
        }
        if(isset($requestData['active'])){
            $requestData['active'] = 1;
            Session::put("active",$requestData['active']);
        }else{
            $requestData['active'] = 0;
            Session::put("active",$requestData['active']);
        }
        $this->_userRepository->updateUser($requestData['id'],$requestData['username'],$requestData['email'],$requestData['fullname'],$requestData['website'],$requestData['active']);

        return redirect('/user/index')->with('message','Update user information successfully');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Request $request, $id)
    {
        $this->_userRepository->deleteUser($id);

        return redirect('user/index')->with('message','Delete user information successfully');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile() {

        $user_id = Auth::user()->id;


        $profile = $this->_userRepository->getById($user_id);

        return view('user.usersetting', compact('profile'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function updateprofile(Request $request) {

        $requestData = $request->all();

        $user_id = Auth::user()->id;

        $requestData = $request->all();
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->hasFile("image")){
            $get_name_image = $request->file('image')->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.str::random(60).'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move('public/avatar/',$new_image);

            $this->_userRepository->updateProfileWithAvatar($user_id,$requestData['fullname'],$requestData['website'],$requestData['company_name'],$requestData['description'],$new_image);
        }
        $this->_userRepository->updateProfileWithoutAvatar($user_id,$requestData['fullname'],$requestData['website'],$requestData['company_name'],$requestData['description']);

        return redirect('chart/index')->with('message','Update profile successfully');

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showpassword() {
        $user_id = Auth::user()->id;

        $show_password = $this->_userRepository->getById($user_id);
            return view('user.changepassword',compact('show_password'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function changepassword(Request $request){

        $requestData = $request->all();

        $validator = Validation::validatechangepasswordRequest($request);

        if ($validator->fails()) {
            return redirect('user/showpassword')
                ->withErrors($validator)
                ->withInput();
        }

        $user_id = Auth::user()->id;
        $user =$this->_userRepository->getById($user_id);

        $passwordmahoa  = $requestData["oldpassword"];

        if (Hash::check($passwordmahoa, $user->password)) {

            // The passwords match...
            $this->_userRepository->ChangePassword($user_id,$requestData['password']);

            return redirect('user/showpassword')->with('status','Change password success!');

        } else{
            return redirect('user/showpassword')->with('status','Old password fails');
        }
    }
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    //Logout
    public function logout(Request $request) {
        Auth::logout();
        Session::put("paginate",1);
        return redirect('/login')->with('message','Logout successfully');
    }

    public function change_user($id){
        if(Gate::allows("is-admin")){
            $getSpecificUser = $this->_userRepository->getById($id);
            if($getSpecificUser->hasVerifiedEmail()){
                if(Auth::loginUsingId($getSpecificUser->id)){
                    return redirect("dashboard")->with("message","Change user successfully");
                }else{
                    return redirect("login")->with("error","login fail");
                }
            }else{
                return redirect("dashboard")->with("error","This account has not been verifying email ");
            }
        }else{
            return redirect("dashboard")->with("error","You did not have roles to do this function");
        }
    }
}
