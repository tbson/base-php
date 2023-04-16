<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Prog\UseCase\Auth\CommonAuth\CommonAuthFlow;

class CmdGenerateUserToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "app:cmd-generate-user-token {userId}";

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
        $userId = $this->argument("userId");
        $commonAuthFlow = new CommonAuthFlow();
        $result = $commonAuthFlow->generateUserToken($userId);
        dump($result);
    }
}
