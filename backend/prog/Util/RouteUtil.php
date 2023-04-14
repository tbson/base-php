<?php
namespace Prog\Util;

use Illuminate\Support\Facades\Route;

class RouteUtil
{
    public static function getAllRouteInfo()
    {
        $routes = Route::getRoutes();
        return $routes;
    }

    public static function formatRouteTitle($title)
    {
        return ucfirst(strtolower(trim($title)));
    }
}
