<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Src\Service\Account\Schema\UserSchema;
use Src\Service\DbService;
use Src\Setting;

class CmdRandomCommand extends Command {
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
    public function handle() {
        /*
        $schema = new UserSchema();
        $conditions = ["id" => 1];
        $attrs = ["email" => "staff@localhost.dev"];
        $result = DbService::updateItem($schema, $conditions, $attrs);
        dump($result);
        */
        dump(Setting::JWT_EXPIRATION_PERIOD);
        dump(Setting::JWT_REFRESH_PERIOD);
        dump(Setting::OTP_LIFE_TIME);
        dump(Setting::OTP_PER_DAY);
        dump(Setting::PROFILE_TYPE_LABEL[1]);
    }
}
