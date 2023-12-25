<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResetPassController;
use Illuminate\Auth\Notifications\ResetPassword;


Route::get('/reset-password', function () {
    return view('mail/resetPass');
});

Route::post('/resetpass',[ResetPassController::class,'resetPass']);