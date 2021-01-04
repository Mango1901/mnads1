<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calllog extends Model
{
        //table calllog
        protected $table='call_log';
        protected $fillable=[
          'user_id','call_id','ip','location','create_at','update_at'
        ];
        protected $primaryKey='id';
    public function Call()
    {
        return $this->belongsTo('App\Call','call_id','id');
    }
}
