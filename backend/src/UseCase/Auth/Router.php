<?php

use Illuminate\Support\Facades\Route;
use Src\Setting;
use Src\UseCase\Auth\BasicAuth\Login\BasicAuthLoginCtrl;
use Src\UseCase\Auth\CommonAuth\Logout\CommonAuthLogoutCtrl;

$admin = Setting::PROFILE_TYPE["ADMIN"];
$staff = Setting::PROFILE_TYPE["STAFF"];

Route::group(
    [
        "prefix" => "auth",
        "middleware" => ["api"],
        "profile_types" => [$admin, $staff],
    ],
    function () {
        Route::post("/basic-auth/login", [BasicAuthLoginCtrl::class, "login"]);
        Route::post("/common-auth/logout", [
            CommonAuthLogoutCtrl::class,
            "logout",
        ]);
        Route::get("/common-auth/refresh-token", [
            CommonAuthCtrl::class,
            "refreshToken",
        ]);
        Route::get("/common-auth/refresh-check", [
            CommonAuthCtrl::class,
            "refreshCheck",
        ]);
    },
);
