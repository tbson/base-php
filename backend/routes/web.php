<?php

use Illuminate\Support\Facades\Route;
# use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", function () {
    /*
    $test_array = [
        "test" => "test",
        "test2" => "test2",
        "test3" => "test3",
    ];
    $output = new Symfony\Component\Console\Output\ConsoleOutput();
    $output->writeln(strval($test_array));
    */
    return view("welcome");
});
