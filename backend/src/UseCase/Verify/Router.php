<?php

use Illuminate\Support\Facades\Route;
use Src\UseCase\Verify\Otp\Send\SendOtpCtrl;
use Src\UseCase\Verify\Otp\Verify\VerifyOtpCtrl;
use Src\Setting;

$admin = Setting::PROFILE_TYPE["ADMIN"];
$staff = Setting::PROFILE_TYPE["STAFF"];

Route::group(
    [
        "prefix" => "verify/otp",
    ],
    function () {
        Route::post("/send", [SendOtpCtrl::class, "sendOtp"]);
        Route::post("/verify", [VerifyOtpCtrl::class, "verifyOtp"]);
    },
);
