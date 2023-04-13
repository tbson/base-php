<?php
namespace Src\Util;

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
        dump($title);
        dump(strtolower($title));
        return ucfirst(strtolower(trim($title)));
    }
}
