<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatFaceBook extends Model
{
    //
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'chatfb';
    protected $fillable=[
      'user_id','facebook_id','status','facebook_title'
    ];

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';
}
