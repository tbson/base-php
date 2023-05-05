<?php

use Illuminate\Support\Facades\Route;
use Src\UseCase\Config\Variable\Crud\CrudVariableCtrl;
use Src\Setting;

$admin = Setting::PROFILE_TYPE["ADMIN"];
$staff = Setting::PROFILE_TYPE["STAFF"];

Route::group(
    [
        "prefix" => "config/variable",
        "middleware" => ["api", "rbac"],
        "profile_types" => [$admin],
    ],
    function () {
        Route::get("/", [CrudVariableCtrl::class, "list"]);
        Route::get("/{id}", [CrudVariableCtrl::class, "retrieve"]);
        Route::post("/", [CrudVariableCtrl::class, "create"]);
        Route::put("/{id}", [CrudVariableCtrl::class, "update"]);
        Route::delete("/{id}", [CrudVariableCtrl::class, "delete"]);
        Route::delete("/", [CrudVariableCtrl::class, "deleteList"]);
    },
);
