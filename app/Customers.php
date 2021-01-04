<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $fillable=[
      'user_id','customer_id'
    ];

    protected $table = "customers";

    protected $primaryKey = "id";
}
