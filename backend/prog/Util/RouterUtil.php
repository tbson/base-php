<?php
namespace Prog\Util;

use Illuminate\Support\Facades\Route;

class RouterUtil
{
    public static function getAllRouterInfo()
    {
        $routes = Route::getRoutes();
        $result = [];
        foreach ($routes as $route) {
            if (StrUtil::startsWith($route->uri, "api/v1/") === false) {
                continue;
            }
            $ctrlStr = $route->action["controller"];
            $profileTypes = MapUtil::get($route->action, "profile_types", []);
            $ctrlName = collect(explode("\\", $ctrlStr))->last();
            $ctrlName = str_replace("Ctrl", "", $ctrlName);
            $ctrlArr = explode("@", $ctrlName);
            $module = StrUtil::camelToWords($ctrlArr[0]);
            $action = $ctrlArr[1];
            $titlePrefix = "";
            if (in_array($action, ["list"])) {
                $titlePrefix = "View";
            }
            $result[] = [
                "profile_types" => $profileTypes,
                "title" => RouterUtil::formatRouterTitle(
                    "{$titlePrefix} {$action} {$module}"
                ),
                "module" => $module,
                "action" => $action,
            ];
        }
        return $result;
    }

    public static function formatRouterTitle($title)
    {
        return ucfirst(strtolower(trim($title)));
    }
}
