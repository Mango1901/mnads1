<?php

namespace App\Validations;
use Illuminate\Support\Facades\Validator;

class Validation
{
    public static function validateSignupRequest($request)
    {
        return Validator::make($request->all(),[
            'username' => 'bail|required|min:6|max:10',
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:8',
            'password_confirmation' => 'bail|required|same:password',
        ]);


    }

    public static function validatechangepasswordRequest($request)
    {
        return Validator::make($request->all(),[
            'oldpassword' => 'bail|required|min:8',
            'password' => 'bail|required|min:8',
            'password_confirmation' => 'bail|required|same:password',
        ]);


    }

     public static function validateloginRequest($request)
    {
        return Validator::make($request->all(),[
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:8'
        ]);

    }

    public static function validatefacebookRequest($request)
    {
        return Validator::make($request->all(),[
            'facebookid' => 'required'
        ]);

    }
    public static function validatefacebookupdateRequest($request)
    {
        return Validator::make($request->all(),[
            'facebookid' => 'required'
        ]);

    }
    public static function validatezaloRequest($request)
    {
        return Validator::make($request->all(),[
            'zalo_name' => 'required'
        ]);
    }
    public static function validatecontactRequest($request){
        return Validator::make($request->all(),[
            'title'=>'required',
            'number'=>'required',
            'description'=>'required',
        ]);
    }
    public static function validatemapRequest($request){
        return Validator::make($request->all(),[
            'map'=>'required',
        ]);
    }
}
