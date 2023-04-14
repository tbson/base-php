<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Prog\Srv\Org\Seeder\WorkspaceSeeder;
use Prog\Srv\Account\Seeder\UserSeeder;

class CmdRandomCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "app:cmd-random-command";

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
        $workspace = WorkspaceSeeder::one(1);
        $admin = UserSeeder::oneAdmin(1, $workspace->id);
    }
}
