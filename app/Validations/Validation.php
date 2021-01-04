<?php

namespace App\Validations;
use Illuminate\Support\Facades\Validator;
class Validation
{
    public static function validateSignupRequest($request)
    {
        return Validator::make($request->all(),[
            'username' => 'required|string|without_spaces|max:255|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:8',
            'password_confirmation' => 'bail|required|same:password',
        ]);


    }
    public static function validateUpdateRequest($request)
    {
        return Validator::make($request->all(),[
            'username' => 'required|string|without_spaces|max:255|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'email' => 'bail|required|email',
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
            'email' => 'bail|required|',
            'password' => 'bail|required|min:8'
        ]);

    }

    public static function validatefacebookRequest($request)
    {
        return Validator::make($request->all(),[
            'facebookid' => 'required|min:1|max:150'
        ]);

    }
    public static function validatefacebookupdateRequest($request)
    {
        return Validator::make($request->all(),[
            'facebookid' => 'required|min:1|max:150'
        ]);
    }
    public static function validatezaloRequest($request)
    {
        return Validator::make($request->all(),[
            'zalo_name' => 'required|min:1|max:50'
        ]);
    }
    public static function validatezaloUpdateRequest($request)
    {
        return Validator::make($request->all(),[
            'zalo_name' => 'required|min:1|max:50'
        ]);
    }
    public static function validatecontactRequest($request){
        return Validator::make($request->all(),[
            'title'=>'required|min:1|max:50',
            'number'=>'required|min:1|max:50',
            'description'=>'max:255',
        ]);
    }
    public static function validatecontactUpdateRequest($request){
        return Validator::make($request->all(),[
            'title'=>'required|min:1|max:50',
            'number'=>'digits_between:1,11',
            'description'=>'max:255',
        ]);
    }
    public static function validatemapRequest($request){
        return Validator::make($request->all(),[
            'map_title'=>'required|min:1|max:50',
            'map'=>'required|min:1|max:50',
        ]);
    }
    public static function validatemapUpdateRequest($request){
        return Validator::make($request->all(),[
            'map_title'=>'required|min:1|max:50',
            'map'=>'required|min:1|max:50',
        ]);
    }
    public static function ValidateCallRequest($request){
        return Validator::make($request->all(),[
            'name' => 'bail||max:50',
            'phone_number' =>  'digits_between:1,11',
            'description' => 'bail|max:255',
        ]);
    }
    public static function ValidateCallUpdateRequest($request){
        return Validator::make($request->all(),[
            'name' => 'bail|min:1|max:50',
            'phone_number' => 'digits_between:1,11',
            'description' => 'bail|max:255',
        ]);
    }
}
