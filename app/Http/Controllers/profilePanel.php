<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\RequestDb;
use App\ResponseDb;
use Illuminate\Support\Facades\DB;
use App\User;
use Session;

class profilePanel extends Controller
{
    //
    protected $partnerCode = '';
    protected $requestCount = 0;
    protected $allRequest = 0;
    protected $resSuccess = 0;

    public function __construct()
    {
        $this->middleware(['auth', 'profile'])
            ->except('index', 'show');
    }

    protected function edit($id)
    {
        if($id != Auth::user()->id){
            return redirect()->route('home');
        }
        $userInfo = User::findOrFail($id);
        return view('profile.edit', compact('userInfo'));
    }
    public function update(Request $request, $id)
    {
        if ($id != Auth::user()->id) {
            return redirect()->route('home');
        }
        $this->validate($request, [
            'email' => 'required|email|min:8',
            'newpassword' => 'required|min:8',
            'repassword' => 'required|min:8',
        ]);
        if ($request->input('newpassword') != $request->input('repassword')) {
            Session::flash('error_mes', 'Lỗi! Yêu cầu mật khẩu mới và mật khẩu nhập lại phải giống nhau');
            return redirect()->route('profile.edit', $id);
        } else {
            $userInfo = User::findOrFail($id);
            if ($userInfo->email != $request->input('email')) {
                Session::flash('error_mes', 'Lỗi! Email Không Đúng ');
                return redirect()->route('profile.edit', $id);
            } else {
                $userInfo->password = bcrypt($request->input('newpassword'));
                $userInfo->save();
                Session::flash('success_mes', 'Mật khẩu mới đã được cập nhật');
                return redirect()->route('profile.edit',
                    $userInfo->id);
            }
        }
    }

    protected function index()
    {
        $this->partnerCode = Auth::user()->partnerCode;
        $this->_getCountToday();
        $this->_getCountRequest();
        $this->_getResSuccess();
        $data = [
            'countToday' => $this->requestCount,
            'allRequest' => $this->allRequest,
            'allResponse' => $this->allRequest
        ];
        return view('home')->with($data);
    }

    function _getCountToday()
    {
        $this->requestCount = DB::table('Request')
            ->where('created_at', '>', DB::raw('concat(curdate())'))
            ->where('partnerCode', $this->partnerCode)
            ->count();
    }

    function _getCountRequest()
    {
        $this->allRequest = DB::table('Request')
            ->where('created_at', '>', 1)
            ->where('partnerCode', $this->partnerCode)
            ->count();
    }

    function _getResSuccess()
    {
        $this->resSuccess = DB::table('Response')
            ->where('created_at', '>', 1)
            ->where('partnerCode', $this->partnerCode)
            ->count();
    }
}
