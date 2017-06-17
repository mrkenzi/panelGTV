<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponseDb extends Model
{
    //
    protected $fillable = [
        'transId', 'partnerCode', 'resCode','resMsg','resData','created_at','updated_at'
    ];
    protected $table = 'Response';
}
