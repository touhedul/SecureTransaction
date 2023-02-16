<?php

namespace App\Http\Middleware;

use App\Models\CheckUser;
use Closure;
use Illuminate\Http\Request;

class QRCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $checkUser = CheckUser::where('user_id', auth()->id())->where('status', 0)->first();
        if ($checkUser) {
            return redirect()->route('user.scanQRCode');
        } 
        return $next($request);
    }
}
