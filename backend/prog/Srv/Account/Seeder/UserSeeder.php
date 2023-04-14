<?php

namespace Prog\Srv\Account\Seeder;
use Prog\Srv\Account\Schema\UserSchema;
use Prog\Business\GlobalConst;

/**
 * @module Prog\Srv\Account\Seeder\UserSeeder;
 */
class UserSeeder
{
    private static function data($index, $workspaceId, $profileType)
    {
        $result = [
            "workspace_id" => $workspaceId,
            "profile_type" => $profileType,
            "name" => "name {$index}",
            "email" => "test{$index}@gmail.com",
            "mobile" => "090669651{$index}",
            "password" => "password{$index}",
            "is_owner" => false,
        ];
        if ($profileType == GlobalConst::$PROFILE_TYPE["ADMIN"]) {
            $result["is_owner"] = true;
        }
        return $result;
    }

    private static function get_by($attr)
    {
        return UserSchema::where($attr)->first();
    }

    private static function create($attr)
    {
        return UserSchema::create($attr);
    }

    private static function one($index, $workspaceId, $profileType)
    {
        $data = self::data($index, $workspaceId, $profileType);
        $existItem = self::get_by($data);
        if ($existItem) {
            return $existItem;
        }
        return self::create($data);
    }

    private static function list($index, $workspaceId, $profileType)
    {
        $result = [];
        for ($i = 1; $i <= $index; $i++) {
            array_push($result, self::one($i, $workspaceId, $profileType));
        }
        return $result;
    }

    public static function oneAdmin($index, $workspaceId)
    {
        return self::one($index, $workspaceId, GlobalConst::$PROFILE_TYPE["ADMIN"]);
    }

    public static function listAdmin($index, $workspaceId)
    {
        return self::list($index, $workspaceId, GlobalConst::$PROFILE_TYPE["ADMIN"]);
    }

    public static function oneStaff($index, $workspaceId)
    {
        return self::one($index, $workspaceId, GlobalConst::$PROFILE_TYPE["STAFF"]);
    }

    public static function listStaff($index, $workspaceId)
    {
        return self::list($index, $workspaceId, GlobalConst::$PROFILE_TYPE["STAFF"]);
    }
}
