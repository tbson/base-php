<?php

use Illuminate\Support\Facades\Route;
use Src\UseCase\Role\Group\Crud\CrudGroupCtrl;
use Src\Setting;

$admin = Setting::PROFILE_TYPE["ADMIN"];

Route::group(
    [
        "prefix" => "role/group",
        "middleware" => ["api", "rbac"],
        "profile_types" => [$admin],
    ],
    function () {
        Route::get("/", [CrudGroupCtrl::class, "list"]);
        Route::get("/{id}", [CrudGroupCtrl::class, "retrieve"]);
        Route::post("/", [CrudGroupCtrl::class, "create"]);
        Route::put("/{id}", [CrudGroupCtrl::class, "update"]);
        Route::delete("/{id}", [CrudGroupCtrl::class, "delete"]);
        Route::delete("/", [CrudGroupCtrl::class, "deleteList"]);
    },
);
