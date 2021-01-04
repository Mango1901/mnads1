<?php

namespace App\Http\Controllers\Admin;

use App\Repository\UserRepository;
use App\Validations\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Psr\Log\NullLogger;
use function encrypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Users;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;


class AdminController extends Controller
{
    protected $_userRepository;

    /**
     * AdminController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->_userRepository = $userRepository;
    }


    public function Home()
    {
        return view("welcome");
    }
    public function login()
    {

        return view('admin_login');
    }

    //exec login
    public function execlogin(Request $request)
    {
        $requestData = $request->all();

        $validator = Validation::validateloginRequest($request);

        if ($validator->fails()) {
            return redirect('login')
                ->withErrors($validator)
                ->withInput();
        }

        // Nếu dữ liệu hợp lệ sẽ kiểm tra trong csdl
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password]) || Auth::attempt(['username'=>$requestData['email'],'password'=>$password])) {
                    $user = $this->_userRepository->CheckEmail($email);
                    if(Auth::user()->email_verified_at=='NULL'){
                        $user->sendEmailVerificationNotification();
                    }
                    return redirect('dashboard')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            return redirect('login')->with('error', 'wrong username or password!');
        }
    }

    public function register()
    {

        return view('admin_register');
    }

    public function forgotpassword()
    {
        return view('admin_forgetpassword');
    }

    public function sent(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $requestData = $request->all();
        $email = $requestData["email"];
        $check_email_exists = $this->_userRepository->CheckEmail($email);
        $url = "http://" . $_SERVER['HTTP_HOST'] . '/reset-password';
        if ($check_email_exists) {
            $this->_userRepository->UpdateRefreshToken($email,date("Y-m-d H:i:s", strtotime("+1 hour")),Str::random(60));
            Mail::send('mail.forgotpassword', array('token' => $check_email_exists->token_reset_password, 'url' => $url), function ($message)  use ($email) {
                $message->from('hieu.tuhai2001@gmail.com', 'Cong ty phuong dong');
                $message->to($email, 'Visitor')->subject('Visitor Feedback!');
            });
            Session::flash('flash_message', 'Send message successfully!');
        } else {
            return redirect('forgot-password')->with('error', 'This email was not existed ');
        }
        return redirect('/login')->with("message", 'Please check your email to get your access Token! This token will expire in 1 hour ');
    }
    public function reset_password()
    {
        return view("password.reset_password");
    }
    public function reset_password_save(Request $request)
    {
        $requestData = $request->all();
        $user = $this->_userRepository->CheckEmailAndRefreshToken($requestData['email'],$requestData['token_reset_password']);
        if ($user) {
            request()->validate([
                'password' => 'bail|required|min:8',
                'password_confirmation' => 'bail|required|same:password',
            ]);
            $this->_userRepository->UpdateRefreshPassword($requestData['email'],$requestData['password'],$requestData['token_reset_password']);
                return redirect("login")->with('message', 'Reset password successfully');
        } else {
            return redirect("login")->with("error", "Your Token or email did not correct or your token was running out of time");
        }
    }
    public function create(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $requestData = $request->all();
        Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });
        $validator = Validation::validateSignupRequest($request);

        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }
        $check_users_email = $this->_userRepository->CheckEmail($requestData['email']);
        $check_users_name = $this->_userRepository->CheckUserName($requestData['username']);
        if ($check_users_email) {
            return redirect('register')->with('error', 'This email had already been used');
        }
        if ($check_users_name) {
            return redirect('register')->with('error', 'This username had already been used');
        }
            $this->_userRepository->CreateUser($requestData['username'],$requestData["password"],$requestData['email'],$requestData["fullname"],$requestData["website"]);
                return redirect('login')->with('message', 'Create users successfully!');
    }
    public function extend_date(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $requestData = $request->all();
        $user =$this->_userRepository->CheckEmail($requestData['email']);
        if($user){
            if($requestData['date']){
               if($requestData['date'] == 1){
                   $user->active_expired = date("Y-m-d H:i:s", strtotime("+1 year"));
                   $user->roles = 1;
                   $user->save();
               }else if($requestData['date'] == 2){
                   $user->active_expired = date("Y-m-d H:i:s", strtotime("+2 year"));
                   $user->roles = 1;
                   $user->save();
               }else{
                   $user->active_expired = date("Y-m-d H:i:s", strtotime("+3 year"));
                   $user->roles = 1;
                   $user->save();
               }
            }
        }else{
            return redirect('login')->with("error","This email is not existed");
        }
        return redirect('login')->with("message","Extend Active Expired successfully");
    }

    public function show_dashboard()
    {
        return view('admin.dashborad');
    }
}
