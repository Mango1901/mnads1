<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleAds extends Model
{

    protected $fillable=[
      'user_id','access_token','expired_in','refresh_token','scope','token_type'
    ];
    protected $primaryKey='id';
    protected $table = 'google_ads';
}
