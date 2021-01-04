<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\GoogleLogin;
use App\Social;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class SocialController extends Controller
{
    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }
    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            $user = User::where("id",$account->user_id)->first();
            //login in vao trang quan tri
            if(Auth::attempt(["email"=>$user->email,"password"=>""])){
            $account_name = User::where('id', $account->user_id)->first();
            Session::put('id', $account_name->id);
            return redirect('/dashboard')->with('message', 'Đăng nhập thành công');
            }else{
                return redirect('/login')->with('error', 'Đăng nhập thất bại');
            }
        }else{

            $hieu = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);
            $orang = User::where('email',$provider->getEmail())->first();
            if(!$orang){
                $orang = User::create([
                    'token'=>Str::random(60),
                    'username'=>$provider->getName(),
                    'token_expired'=>date("Y-m-d H:i:s",strtotime("+30 day")),
                    'active_expired'=>date("Y-m-d",strtotime('+30 day')),
                    'fullname' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => bcrypt(""),
                    'email_verified_at'=>date("Y-m-d H:i:s"),
                ]);
            }
            $hieu->login()->associate($orang);
            $hieu->save();
            $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
            $user = User::where("id",$account->user_id)->first();
            if(Auth::attempt(["email"=>$user->email,"password"=>""])){
                return redirect('/dashboard')->with('message', 'Đăng nhập thành công');
            }else{
                return redirect('/login')->with('error', 'Đăng nhập thất bại');
            }
        }
    }
    public function login_google(){
        return Socialite::driver('google')->redirect();
    }
    public function callback_google(){
        $users = Socialite::driver('google')->stateless()->user();
        // return $users->id;
        $authUser = $this->findOrCreateUser($users,'google');
        if(Auth::attempt(["email"=>$users->email,"password"=>""])){
            return redirect('/dashboard')->with('message', 'Đăng nhập thành công');
        }else{
            return redirect("login")->with("error","Đăng nhập thất bại");
        }
    }
    public function findOrCreateUser($users,$provider){
        $authUser = GoogleLogin::where('provider_user_id', $users->id)->first();
        if($authUser){
            return $authUser;
        }

        $hieu = new GoogleLogin([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider)
        ]);

        $orang = User::where('email',$users->email)->first();

        if(!$orang){
            $orang = User::create([
                'token'=>Str::random(60),
                'username'=>$users->name,
                'token_expired'=>date("Y-m-d H:i:s",strtotime("+30 day")),
                'active_expired'=>date("Y-m-d",strtotime('+30 day')),
                'fullname' => $users->name,
                'email' => $users->email,
                'password' => bcrypt(""),
                'email_verified_at'=>date("Y-m-d H:i:s"),
            ]);
        }
        $hieu->login_google()->associate($orang);
        $hieu->save();
        if(Auth::attempt(["email"=>$users->email,"password"=>""])){
            return redirect('/dashboard')->with('message', 'Đăng nhập thành công');
        }else{
            return redirect("login")->with("error","Đăng nhập thất bại");
        }
    }
}
