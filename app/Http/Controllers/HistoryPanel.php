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
        $todayRequest = DB::table('request')
            ->join('response', function ($join) {
                $join->on('request.transId', '=', 'response.transId')
                    ->where('request.partnerCode', $this->partnerCode)
                    ->where('request.created_at', '>=',DB::raw('concat(curdate())'));
            })
            ->orderBy('request.created_at', 'desc')
            ->select('request.*', 'response.*')
            ->paginate(10);
        return view('history.request')->with('dataRqs',$todayRequest);
    }

    protected function _searchHistory(Request $rq){
        $query = RequestDb::query();
        $query->join('response','request.transId', '=', 'response.transId');
        $query->where('request.partnerCode', $this->partnerCode);
        $msgResult = "Kết quả tìm kiếm ";
        if($rq['transId'] != ''){
            $query->where('request.transId', $rq['transId']);
            $msgResult .="- Mã giao dịch:".$rq['transId'];
        }
        if($rq['func'] != ''){
            $query->where('request.func', $rq['func']);
            $msgResult .="- Hàm kết nối:".$rq['func'];
        }
        if($rq['telco'] != ''){
            $query->where('request.telco', $rq['telco']);
            $msgResult .="- Loại thẻ:".$rq['telco'];
        }
        if($rq['cardPrice'] != ''){
            $query->where('request.cardPrice', intval($rq['cardPrice']));
            $msgResult .="- Giá trị thẻ:".$rq['cardPrice'];
        }

        $results = $query->paginate(10);
        //dd($results);
        return view('history.result',['dataResults'=> $results,'msgResult'=>$msgResult]);
    }
}
