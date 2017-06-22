<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyinManager extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'mBuyin']);
    }
}
