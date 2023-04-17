<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use Prog\Util\CryptoUtil;
use Prog\Srv\Account\Seeder\UserSeeder;
use Prog\Srv\Role\Schema\GroupSchema;
use Prog\Srv\Role\Schema\PemSchema;
use Prog\Business\GlobalConst;

class CmdAccountSeeding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "app:cmd-account-seeding";

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
        DB::transaction(function () {
            $adminProfile = GlobalConst::$PROFILE_TYPE["ADMIN"]["value"];
            $staffProfile = GlobalConst::$PROFILE_TYPE["STAFF"]["value"];

            $admin_group_ids = [];
            $staff_group_ids = [];
            foreach (GlobalConst::$PROFILE_TYPE as $profileType) {
                $group = GroupSchema::create([
                    "profile_type" => $profileType["value"],
                    "title" => $profileType["label"],
                    "default" => true,
                ]);
                $pems = PemSchema::whereJsonContains(
                    "profile_types",
                    $group->profile_type
                )->get();
                $group->pem()->attach($pems);

                if ($group->profile_type == $adminProfile) {
                    $admin_group_ids = array_merge(
                        $admin_group_ids,
                        $pems->pluck("id")->toArray()
                    );
                } elseif ($group->profile_type == $staffProfile) {
                    $staff_group_ids = array_merge(
                        $staff_group_ids,
                        $pems->pluck("id")->toArray()
                    );
                }
            }

            $admin = UserSeeder::oneAdmin(1);
            $admin->email = "admin@localhost.dev";
            $admin->password = CryptoUtil::hashPwd("Qwerty!@#456");
            $admin->group_ids = $admin_group_ids;
            $admin->save();

            $staff = UserSeeder::oneStaff(2);
            $staff->email = "staff@localhost.dev";
            $staff->password = CryptoUtil::hashPwd("Qwerty!@#456");
            $staff->group_ids = $staff_group_ids;
            $staff->save();
        });
    }
}
