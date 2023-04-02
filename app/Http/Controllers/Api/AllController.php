<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllController extends Controller
{


    public function login(Request $request)
    {
        if (Auth::attempt($request->only(['account_number', 'password']))) {
            $user = User::where('account_number', $request->account_number)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'user' => $user,
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Email & Password does not match with our record.',
        ], 401);
    }


    public function successQR(Request $request)
    {
        $request->validate([
            'qr_data' => 'required',
            'mac_address' => 'required'
        ]);

        if($request->qr_data == $request->mac_address){
            $checkUser = CheckUser::where('user_id', auth()->id())->where('status', 0)->first();


            if ($checkUser) {
                $checkUser->status = 1;
                $checkUser->save();
                return "Login Successful";
            }
            return "Not Found";
        }else{
            return "invalid qr or mac data";
        }

    }
}
