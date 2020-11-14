<?php

namespace App\Http\Controllers\Admin;

use App\Validations\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use function encrypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Users;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{


    public function login(){

    	return view('admin_login');
    }

    //exec login
    public function execlogin(Request $request) {

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

        if (Auth::attempt(['email' => $email, 'password' =>$password])) {
            //return $this->sendLoginResponse($request);
            return redirect('dashboard')
                ->withErrors($validator)
                ->withInput();
        } else {
            return redirect('login')->with('error','wrong username or password!');
        }

    }

    public function register(){

    	return view('admin_register');
    }

    public function forgotpassword(){
        return view('admin_forgetpassword');
    }

    public function sent(Request $request) {

        $requestData = $request->all();
        $email = $requestData["email"];

        Mail::send('mail.forgotpassword', array('name'=>"Huy",'email'=>$email, 'content'=>"Mat khau moi"), function($message){
            $message->from('hello@app.com', 'Your Application');
            $message->to('huy@abc.com', 'Visitor')->subject('Visitor Feedback!');
        });
        Session::flash('flash_message', 'Send message successfully!');

        return redirect('login');

    }

    public function create(Request $request) {

    	$requestData = $request->all();

    	$validator = Validation::validateSignupRequest($request);

    	if ($validator->fails()) {
            return redirect('register')
                        ->withErrors($validator)
                        ->withInput();
        }


        Users::insert(
            array('username'=>$requestData['username'],'password'=>bcrypt($requestData['password']),'email'=>$requestData['email'],'fullname'=>$requestData['fullname'] ,'website'=>$requestData['website'],'token'=>Str::random(60))
            //,'start_time'=>$requestData['start_time'],'active'=>$requestData['active'])
        );

      	return redirect('register');

    }


    public function show_dashboard (){

    	return view ('admin.dashborad');
    }

}
