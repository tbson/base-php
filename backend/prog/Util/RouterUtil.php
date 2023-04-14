<?php
namespace Prog\Util;

use Illuminate\Support\Facades\Route;

class RouterUtil
{
    public static function getAllRouterInfo()
    {
        $routes = Route::getRoutes();
        return $routes;
    }

    public static function formatRouterTitle($title)
    {
        return ucfirst(strtolower(trim($title)));
    }
}
