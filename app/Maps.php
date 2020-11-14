<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maps extends Model
{

     //
     /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $table = 'maps';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';
}
