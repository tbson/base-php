<?php

use Illuminate\Support\Facades\Route;
use Src\Business\GlobalConst;
use Src\UseCase\Auth\BasicAuth\BasicAuthCtrl;
use Src\UseCase\Auth\CommonAuth\CommonAuthCtrl;

$admin = GlobalConst::$PROFILE_TYPE["ADMIN"]["value"];
$staff = GlobalConst::$PROFILE_TYPE["STAFF"]["value"];

Route::group(
    [
        "prefix" => "auth",
        "middleware" => ["api"],
        "profile_types" => [$admin, $staff],
    ],
    function () {
        Route::post("/basic-auth/login", [BasicAuthCtrl::class, "login"]);
        Route::post("/common-auth/logout", [CommonAuthCtrl::class, "logout"]);
    }
);
