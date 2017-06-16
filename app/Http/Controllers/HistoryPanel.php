<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\RequestDb;
use App\ResponseDb;
use Illuminate\Support\Facades\DB;

class HistoryPanel extends Controller
{
    //
    protected $partnerCode = '';

    protected function _getTodayRequest(){
        $this->partnerCode = Auth::user()->partnerCode;
        $todayRequest = DB::table('Request')
            ->join('Response', function ($join) {
                $join->on('Request.transId', '=', 'Response.transId')
                    ->where('Request.partnerCode', $this->partnerCode)
                    ->where('Request.created_at', '>=',DB::raw('concat(curdate())'));
            })
            ->orderBy('Request.created_at', 'desc')
            ->select('Request.*', 'Response.*')
            ->paginate(10);
        return view('history.request')->with('dataRqs',$todayRequest);
    }

    protected function _searchHistory(Request $rq){
        $query = RequestDb::query();
        $query->join('Response','Request.transId', '=', 'Response.transId');
        $query->where('Request.partnerCode', $this->partnerCode);
        $msgResult = "Kết quả tìm kiếm ";
        if($rq['transId'] != ''){
            $query->where('Request.transId', $rq['transId']);
            $msgResult .="- Mã giao dịch:".$rq['transId'];
        }
        if($rq['func'] != ''){
            $query->where('Request.func', $rq['func']);
            $msgResult .="- Hàm kết nối:".$rq['func'];
        }
        if($rq['telco'] != ''){
            $query->where('Request.telco', $rq['telco']);
            $msgResult .="- Loại thẻ:".$rq['telco'];
        }
        if($rq['cardPrice'] != ''){
            $query->where('Request.cardPrice', intval($rq['cardPrice']));
            $msgResult .="- Giá trị thẻ:".$rq['cardPrice'];
        }

        $results = $query->paginate(10);
        //dd($results);
        return view('history.result',['dataResults'=> $results,'msgResult'=>$msgResult]);
    }
}
