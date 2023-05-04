<?php

use Illuminate\Support\Facades\Route;
use Src\UseCase\Verify\Otp\Send\OtpSendCtrl;
use Src\UseCase\Verify\Otp\Verify\OtpVerifyCtrl;
use Src\Setting;

$admin = Setting::PROFILE_TYPE["ADMIN"];
$staff = Setting::PROFILE_TYPE["STAFF"];

Route::group(
    [
        "prefix" => "verify/otp",
    ],
    function () {
        Route::post("/send", [OtpSendCtrl::class, "send"]);
        Route::post("/verify", [OtpVerifyCtrl::class, "verify"]);
    },
);
