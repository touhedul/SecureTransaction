<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CheckUser;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{

    public function scanQRCode()
    {
        return view('user.scanQRCode');
    }

    public function checkUser()
    {
        $checkUser = CheckUser::where('user_id', auth()->id())->where('status', 0)->first();
        if ($checkUser) {
            return 401;
        }else{
            return 200;
        }
    }
}
