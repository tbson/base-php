<?php

use Illuminate\Support\Facades\Route;
use Src\UseCase\Account\Profile\UpdateProfile\UpdateProfileCtrl;
use Src\UseCase\Account\Profile\GetProfile\GetProfileCtrl;

Route::group(
    [
        "prefix" => "auth",
        "middleware" => ["api", "auth"],
    ],
    function () {
        Route::put("/account/profile", [UpdateProfileCtrl::class, "UpdateProfile"]);
        Route::get("/account/profile", [GetProfileCtrl::class, "GetProfile"]);
    },
);
