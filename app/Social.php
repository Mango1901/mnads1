<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = [
        'provider_user_id',  'provider',  'user_id'
    ];

    protected $primaryKey = 'id';
    protected $table = 'socials';
    public function login(){
        return $this->belongsTo('App\User', 'user_id','id');
    }
}
