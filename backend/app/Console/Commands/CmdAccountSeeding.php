<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use Src\Service\Account\Seeder\UserSeeder;
use Src\Service\Role\Schema\GroupSchema;
use Src\Service\Role\Schema\PemSchema;
use Src\Setting;

class CmdAccountSeeding extends Command {
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
    public function handle() {
        DB::transaction(function () {
            $adminProfile = Setting::PROFILE_TYPE["ADMIN"];
            $staffProfile = Setting::PROFILE_TYPE["STAFF"];

            $admin_group_ids = [];
            $staff_group_ids = [];
            foreach (Setting::PROFILE_TYPE_LABEL as $value => $label) {
                $group = GroupSchema::create([
                    "profile_type" => $value,
                    "title" => $label,
                    "default" => true,
                ]);
                $pems = PemSchema::whereJsonContains(
                    "profile_types",
                    $group->profile_type,
                )->get();
                $group->pems()->attach($pems);

                if ($group->profile_type == $adminProfile) {
                    $admin_group_ids = array_merge(
                        $admin_group_ids,
                        $pems->pluck("id")->toArray(),
                    );
                } elseif ($group->profile_type == $staffProfile) {
                    $staff_group_ids = array_merge(
                        $staff_group_ids,
                        $pems->pluck("id")->toArray(),
                    );
                }
            }

            $admin = UserSeeder::oneAdmin(1);
            $admin->email = "admin@localhost.dev";
            $admin->password = "Qwerty!@#456";
            $admin->group_ids = $admin_group_ids;
            $admin->is_owner = true;
            $admin->enabled = true;
            $admin->save();

            $staff = UserSeeder::oneStaff(2);
            $staff->email = "staff@localhost.dev";
            $staff->password = "Qwerty!@#456";
            $staff->group_ids = $staff_group_ids;
            $admin->is_owner = false;
            $admin->enabled = true;
            $staff->save();
        });
    }
}
