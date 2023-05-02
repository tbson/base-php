<?php

use Illuminate\Support\Facades\Route;
use Src\UseCase\Config\Variable\Crud\VariableCrudCtrl;
use Src\Setting;

$admin = Setting::PROFILE_TYPE["ADMIN"];
$staff = Setting::PROFILE_TYPE["STAFF"];

Route::group(
    [
        "prefix" => "config/variable/crud",
        "middleware" => ["api", "rbac"],
        "profile_types" => [$admin],
    ],
    function () {
        Route::get("/", [VariableCrudCtrl::class, "list"]);
        Route::get("/{id}", [VariableCrudCtrl::class, "retrieve"]);
    },
);
