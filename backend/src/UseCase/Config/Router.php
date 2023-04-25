<?php

use Illuminate\Support\Facades\Route;
use Src\UseCase\Config\Variable\Crud\VariableCrudCtrl;
use Src\Business\BusinessConst;

$admin = BusinessConst::$PROFILE_TYPE["ADMIN"]["value"];
$staff = BusinessConst::$PROFILE_TYPE["STAFF"]["value"];

Route::group(
    [
        "prefix" => "config/variable/crud",
        "middleware" => ["api", "rbac"],
        "profile_types" => [$admin],
    ],
    function () {
        Route::get("/", [VariableCrudCtrl::class, "list"]);
        Route::get("/{id}", [VariableCrudCtrl::class, "retrieve"]);
    }
);
