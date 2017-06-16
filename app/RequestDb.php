<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestDb extends Model
{
    //
    protected $fillable = [
        'transId', 'partnerCode', 'refName','func','telco','cardPrice','cardQuanlity','created_at','updated_at'
    ];
    protected $table = 'request';
    public function scopeOfTransId($query, $input)
    {
        return $query->where('transId', $input);
    }
    public function scopeOfFunc($query, $input)
    {
        return $query->where('func', $input);
    }
    public function scopeOfTelco($query, $input)
    {
        return $query->where('telco', $input);
    }
    public function scopeOfCardPrice($query, $input)
    {
        return $query->where('cardPrice', $input);
    }
}
