<?php

namespace App\Http\Controllers\User;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // return auth()->user()->roles;
        $transactions = Transaction::where('user_id', auth()->id())->latest()->get();
        return view('user.dashboard', compact('transactions'));
    }

    public function cashout(Request $request)
    {
        if ($request->amount > auth()->user()->balance) {
            return back()->with('error', 'Cashout amount is high');
        }
        $transaction = new Transaction();
        $transaction->user_id = auth()->id();
        $transaction->amount = $request->amount;
        $transaction->save();
        $user = auth()->user();
        $user->balance -= $request->amount;
        $user->save();
        return back()->with('success', 'Cashout Successful');
    }
}
