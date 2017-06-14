<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestDb extends Model
{
    //
    protected $fillable = [
        'name', 'email', 'password','partnerCode','money'
    ];
}
