<?php

use Illuminate\Support\Facades\Route;
use Src\Business\GlobalConst;
use Src\UseCase\Auth\BasicAuth\BasicAuthCtrl;

$admin = GlobalConst::$PROFILE_TYPE["ADMIN"]["value"];
$staff = GlobalConst::$PROFILE_TYPE["STAFF"]["value"];

Route::group(
    [
        "prefix" => "auth/basic-auth",
        "middleware" => ["api"],
        "profile_types" => [$admin, $staff],
    ],
    function () {
        Route::post("/login", [BasicAuthCtrl::class, "login"]);
    }
);
