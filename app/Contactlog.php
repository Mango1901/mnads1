<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contactlog extends Model
{
    protected $fillable=[
        'user_id','lienhe_id','ip','location','mobile','description','create_at','update_at'
    ];
    protected $table='lienhe_log';
    protected $primaryKey='id';
    public function Contact()
    {
        return $this->belongsTo('App\Contact','lienhe_id','id');
    }
}
