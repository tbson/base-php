<?php

use Illuminate\Support\Facades\Route;
use Prog\UseCase\Config\Variable\VariableCtrl;

Route::group(["prefix" => "config/variable", "middleware" => "api"], function () {
    Route::get("/", [VariableCtrl::class, "list"]);
    Route::get("/{id}", [VariableCtrl::class, "retrieve"]);
});
