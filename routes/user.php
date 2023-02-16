<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\QRCodeController;

Auth::routes();
// Auth::routes(['verify' => true]);
// Social Login
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('login.social');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');


Route::group(['middleware' => ['role:user'], ['auth', 'preventBackHistory', 'blockIp', 'localaization']], function () {
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {


        Route::get('scanQRCode', [QRCodeController::class, 'scanQRCode'])->name('scanQRCode');
        Route::get('check-user', [QRCodeController::class, 'checkUser'])->name('checkUser');
        //dashboard
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('qrcode');
        Route::post('cashout', [DashboardController::class, 'cashout'])->name('cashout');
        //User Profile
        Route::get('change-password', [ProfileController::class, 'changePasswordView'])->name('change.password');
        Route::post('change-password', [ProfileController::class, 'changePassword'])->name('change.password');
        Route::get('profile', [ProfileController::class, 'profileView'])->name('profile.view');
        Route::post('profile', [ProfileController::class, 'profileChange'])->name('profile.change');
    });
});
