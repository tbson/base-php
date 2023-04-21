<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Src\UseCase\Auth\AuthHelper;

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
        $result = AuthHelper::generateUserToken($userId);
        dump($result);
    }
}
