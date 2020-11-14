<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maplog extends Model
{
    //map_log

    protected $fillable=[
        'user_id','map_id','ip','location','create_at','update_at'
    ];
    protected $table='maps_log';
    protected $primaryKey='id';
    public function Maps()
    {
        return $this->belongsTo('App\Maps','map_id','id');
    }
}
