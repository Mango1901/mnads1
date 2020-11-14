<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatFaceBook extends Model
{
    //
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'chatfb';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';
}
