<?php

use Illuminate\Support\Facades\Route;
use Src\Setting;
use Src\UseCase\Auth\BasicAuth\Login\LoginCtrl;
use Src\UseCase\Auth\CommonAuth\Logout\LogoutCtrl;
use Src\UseCase\Auth\CommonAuth\RefreshToken\RefreshTokenCtrl;
use Src\UseCase\Auth\CommonAuth\RefreshCheck\RefreshCheckCtrl;

$admin = Setting::PROFILE_TYPE["ADMIN"];
$staff = Setting::PROFILE_TYPE["STAFF"];

Route::group(
    [
        "prefix" => "auth",
        "middleware" => ["api"],
    ],
    function () {
        Route::post("/basic-auth/login", [LoginCtrl::class, "login"]);
        Route::post("/common-auth/logout", [LogoutCtrl::class, "logout"]);
        Route::post("/common-auth/refresh-token", [
            RefreshTokenCtrl::class,
            "refreshToken",
        ]);
    },
);

Route::group(
    [
        "prefix" => "auth",
        "middleware" => ["api", "auth"],
    ],
    function () {
        Route::get("/common-auth/refresh-check", [
            RefreshCheckCtrl::class,
            "refreshCheck",
        ]);
    },
);
