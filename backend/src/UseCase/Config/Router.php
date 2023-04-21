<?php

use Illuminate\Support\Facades\Route;
use Src\UseCase\Config\Variable\VariableCtrl;
use Src\Business\GlobalConst;

$admin = GlobalConst::$PROFILE_TYPE["ADMIN"]["value"];
$staff = GlobalConst::$PROFILE_TYPE["STAFF"]["value"];

Route::group(
    [
        "prefix" => "config/variable",
        "middleware" => ["api", "rbac"],
        "profile_types" => [$admin],
    ],
    function () {
        Route::get("/", [VariableCtrl::class, "list"]);
        Route::get("/{id}", [VariableCtrl::class, "retrieve"]);
    }
);