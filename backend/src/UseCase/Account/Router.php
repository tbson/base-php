<?php

use Illuminate\Support\Facades\Route;
use Src\UseCase\Account\Profile\UpdateProfile\UpdateProfileCtrl;
use Src\UseCase\Account\Profile\GetProfile\GetProfileCtrl;

Route::group(
    [
        "prefix" => "account",
        "middleware" => ["api", "auth"],
    ],
    function () {
        Route::get("/profile", [GetProfileCtrl::class, "GetProfile"]);
        Route::put("/profile", [UpdateProfileCtrl::class, "UpdateProfile"]);
    },
);
