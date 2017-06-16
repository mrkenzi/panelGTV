<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\RequestDb;
use App\ResponseDb;
use Illuminate\Support\Facades\DB;

class profilePanel extends Controller
{
    //
    protected $partnerCode = '';
    protected $requestCount = 0;
    protected $allRequest = 0;
    protected $resSuccess = 0;

    protected function _getBasicInfo(){
        $this->partnerCode = Auth::user()->partnerCode;
        $this->_getCountToday();
        $this->_getCountRequest();
        $this->_getResSuccess();
        $data = [
            'countToday'=>$this->requestCount,
            'allRequest' => $this->allRequest,
            'allResponse' => $this->allRequest
        ];
        return view('profile.info')->with($data);
    }

    function _getCountToday(){
        $this->requestCount = DB::table('Request')
            ->where('created_at','>',DB::raw('concat(curdate())'))
            ->where('partnerCode',$this->partnerCode)
            ->count();
    }
    function _getCountRequest(){
        $this->allRequest = DB::table('Request')
            ->where('created_at','>',1)
            ->where('partnerCode',$this->partnerCode)
            ->count();
    }
    function _getResSuccess(){
        $this->resSuccess = DB::table('Response')
            ->where('created_at','>',1)
            ->where('partnerCode',$this->partnerCode)
            ->count();
    }
}
