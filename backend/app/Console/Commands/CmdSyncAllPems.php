<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Src\Util\RouteUtil;
use Src\Util\StrUtil;

class CmdSyncAllPems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "app:cmd-sync-all-pems";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Command description";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $routes = RouteUtil::getAllRouteInfo();
        $result = [];
        foreach ($routes as $route) {
            if (StrUtil::startsWith($route->uri, "api/v1/") === false) {
                continue;
            }
            $ctrlStr = $route->action["controller"];
            $ctrlName = collect(explode("\\", $ctrlStr))->last();
            $ctrlName = str_replace("Ctrl", "", $ctrlName);
            $ctrlArr = explode("@", $ctrlName);
            dump($ctrlArr);
            $module = StrUtil::camelToWords($ctrlArr[0]);
            dump($module);
            $action = $ctrlArr[1];
            $titlePrefix = "";
            if (in_array($action, ["list"])) {
                $titlePrefix = "View";
            }
            $result[] = [
                "title" => RouteUtil::formatRouteTitle(
                    "{$titlePrefix} {$action} {$module}"
                ),
                "module" => $module,
                "action" => $action,
            ];
        }
        dump($result);
        return $result;
    }
}
