<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chatzalolog extends Model
{
    //zalolog
    protected $fillable=[
        'user_id','zalo_id','ip','location','create_at','update_at'
    ];
    protected $table='chatzalo_log';
    protected $primaryKey='id';
    public function ChatZalo()
    {
        return $this->belongsTo('App\ChatZalo','zalo_id','id');
    }
}
