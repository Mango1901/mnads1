<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatZalo extends Model
{

    //
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'chatzalo';
    protected $fillable=[
      'user_id','zalo_name','status','zalo_title'
    ];
    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';
}
