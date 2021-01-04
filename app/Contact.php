<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
     //
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lienhe';
    protected $fillable=[
      'id','user_id','title','number','description','status'
    ];
    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';
}
