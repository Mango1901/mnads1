<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{

    //
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'call';
    protected $fillable = [
        'user_id','name','phone_number','description'
    ];
    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';
}
