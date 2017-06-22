<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\RequestDb;
use App\ResponseDb;
use Session;
use App\User;
use Illuminate\Support\Facades\Auth;

class QlgdController extends Controller
{
    //
    protected $listUser = [];
    protected $thisMonth = 12;
    protected $thisDay = 31;
    protected $thisYear = 2017;
    protected $thisTime = '2017-12-31';
    protected $arrayLabel = [];

    public function __construct()
    {
        $this->middleware(['auth', 'mTrans']);
        $this->listUser = User::orderBy('created_at', 'desc')->pluck('email', 'partnerCode');
        $this->thisDay = intval(date('d'));
        $this->thisMonth = intval(date('m'));
        $this->thisYear = intval(date('Y'));
        $this->thisTime = date('Y/m/d');
    }

    private function _getLabels()
    {
        $this->arrayLabel = ['labels' => [], 'dataSets' => []];
        $this->arrayLabel['dataSets'] = [[
            "label" => "Giao Dịch Thành Công",
            'backgroundColor' => [],
            'data' => []
        ], [
            "label" => "Giao Dịch Thất Bại",
            'backgroundColor' => [],
            'data' => []
        ]
        ];

        for ($i = 1; $i <= $this->thisDay; $i++) {
            if ($i < 10) {
                $i = "0" . $i;
            }
            $label = $i . "-" . $this->thisMonth;
            $this->arrayLabel['labels'][] = $label;
            $fullDate = $this->thisYear . "-" . $this->thisMonth . "-" . $i;
            $this->_getDatasets($fullDate);
        }
    }

    private function _getDatasets($dateGet)
    {
        $countSuccess = DB::table('Response')
            ->whereDate('created_at', $dateGet)
            ->where('resCode', '00')
            ->count();
        $countFail = DB::table('Response')
            ->whereDate('created_at', $dateGet)
            ->where('resCode', '<>', '00')
            ->count();
        $this->arrayLabel['dataSets'][0]['data'][] = $countSuccess;
        $this->arrayLabel['dataSets'][0]['backgroundColor'][] = 'rgba(1, 198, 5, 0.8)';
        $this->arrayLabel['dataSets'][1]['data'][] = $countFail;
        $this->arrayLabel['dataSets'][1]['backgroundColor'][] = 'rgba(198, 1, 1, 0.8)';
    }

    protected function _show()
    {
        $countMonth = DB::table('Request')->whereMonth('Request.created_at', $this->thisMonth)->count();
        $this->_getLabels();
        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 100, 'height' => 20])
            ->labels($this->arrayLabel['labels'])
            ->datasets($this->arrayLabel['dataSets'])
            ->options([]);
        $sumRequest = DB::table('Request')->count();
        return view('transManager.index', ['countMonth' => $countMonth, 'sumRqs' => $sumRequest, 'listUsers' => $this->listUser, 'chartdb' => $chartjs]);
    }

    protected function _transUser(Request $rq)
    {
        $this->validate($rq, [
            'ma_doi_tac' => 'required|min:20'
        ]);
        $getInfoPartner = User::where('partnerCode', $rq['ma_doi_tac'])->firstOrFail();
        $query = RequestDb::query();
        $query->join('Response', 'Request.transId', '=', 'Response.transId');
        $query->where('Request.partnerCode', $rq['ma_doi_tac']);
        $msgResult = "Tìm kiếm giao dịch - Đối tác:" . $getInfoPartner->email;
        if ($rq->input('transId') != '') {
            $query->where('Request.transId', $rq->input('transId'));
            $msgResult .= " - Mã giao dịch:" . $rq->input('transId');
        }
        if ($rq->input('func') != '') {
            $query->where('Request.func', $rq->input('func'));
            $msgResult .= " - Hàm kết nối:" . $rq->input('func');
        }
        if ($rq->input('telco') != '') {
            $query->where('Request.telco', $rq->input('telco'));
            $msgResult .= " - Loại thẻ:" . $rq->input('telco');
        }
        if ($rq->input('cardPrice') != '') {
            $query->where('Request.cardPrice', intval($rq->input('cardPrice')));
            $msgResult .= " - Giá trị thẻ:" . $rq->input('cardPrice');
        }
        $results = $query->paginate(10);
        return view('transManager.result', ['dataResults' => $results, 'msgResult' => $msgResult, 'infoUser' => $getInfoPartner, 'listUsers' => $this->listUser]);
    }
}
