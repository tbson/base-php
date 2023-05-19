<?php

use Illuminate\Support\Facades\Route;
use Src\UseCase\Account\Profile\UpdateProfile\UpdateProfileCtrl;
use Src\UseCase\Account\Profile\GetProfile\GetProfileCtrl;
use Src\UseCase\Account\User\Crud\CrudUserCtrl;
use Src\Setting;

$admin = Setting::PROFILE_TYPE["ADMIN"];
$staff = Setting::PROFILE_TYPE["STAFF"];

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

Route::group(
    [
        "prefix" => "account/user",
        "middleware" => ["api", "rbac"],
        "profile_types" => [$admin, $staff],
    ],
    function () {
        Route::get("/", [CrudUserCtrl::class, "list"]);
        Route::get("/{id}", [CrudUserCtrl::class, "retrieve"]);
    },
);

Route::group(
    [
        "prefix" => "account/user",
        "middleware" => ["api", "rbac"],
        "profile_types" => [$admin, $staff],
    ],
    function () {
        Route::post("/", [CrudUserCtrl::class, "create"]);
        Route::put("/{id}", [CrudUserCtrl::class, "update"]);
        Route::delete("/{id}", [CrudUserCtrl::class, "delete"]);
        Route::delete("/", [CrudUserCtrl::class, "deleteList"]);
    },
);
