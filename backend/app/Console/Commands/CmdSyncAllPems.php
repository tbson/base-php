<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Prog\Util\RouterUtil;
use Prog\Util\StrUtil;
use Prog\Util\MapUtil;

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
        $routes = RouterUtil::getAllRouterInfo();
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
        dump($result);
        return $result;
    }
}
