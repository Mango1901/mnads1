<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chatfblog extends Model
{
    //
    protected $fillable=[
        'user_id','facebook_id','ip','location','create_at','update_at'
    ];
    protected $table='chatfb_log';
    protected $primaryKey='id';
    public function ChatFaceBook()
    {
        return $this->belongsTo('App\ChatFaceBook','facebook_id','id');
    }
}
