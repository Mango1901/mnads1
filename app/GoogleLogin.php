<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleLogin extends Model
{
    protected $fillable = [
        'provider_user_id',  'provider',  'user_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'google_logins';
    public function login_google(){
        return $this->belongsTo('App\User', 'user_id','id');
    }
}
