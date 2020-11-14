<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class authenticationCode extends Model
{
    public $timestamps = true;
    protected $fillable=[
      'user_id','code'
    ];
    protected $primaryKey = 'id';
    protected $table='authentication_codes';
}
