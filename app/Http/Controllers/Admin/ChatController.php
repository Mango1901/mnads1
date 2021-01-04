<?php

namespace App\Http\Controllers\Admin;


use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Chat;
use Illuminate\Support\Facades\Auth;
use App\Events\ChatEvent;
use App\Users;

class ChatController extends Controller
{
    public $data;
    public $model;
    public function __construct()
    {
        $this->data['controller']=__CLASS__;
        $this->model=new Chat();
    }

    public function index(){
        $this->data['data'] = $this->model->join('users','users.username','=','chats.author')->where('status',0)->get();
        $this->data['author']=Auth::user()->username;
        return view('layout.chat',$this->data);
    }

    public function store($requestData){
         $chats=Chat::create($requestData);
        event(
            $e=new ChatEvent($chats)
        );
    }
}
