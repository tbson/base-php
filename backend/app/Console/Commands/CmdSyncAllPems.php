<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Src\Util\RouterUtil;
use Src\Service\Role\PemService;

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

        foreach ($routes as $route) {
            PemService::createPem($route);
        }
        return null;
    }
}
