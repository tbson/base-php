<?php

namespace Prog\Srv\Account\Seeder;
use Prog\Srv\Account\Schema\UserSchema;
use Prog\Business\GlobalConst;

/**
 * @module Prog\Srv\Account\Seeder\UserSeeder;
 */
class UserSeeder
{
    private static function data($index, $profileType)
    {
        $result = [
            "profile_type" => $profileType,
            "name" => "name {$index}",
            "email" => "test{$index}@gmail.com",
            "mobile" => "090669651{$index}",
            "password" => "password{$index}",
            "is_owner" => false,
        ];
        if ($profileType == GlobalConst::$PROFILE_TYPE["ADMIN"]["value"]) {
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

    private static function one($index, $profileType)
    {
        $data = self::data($index, $profileType);
        $existItem = self::get_by($data);
        if ($existItem) {
            return $existItem;
        }
        return self::create($data);
    }

    private static function list($index, $profileType)
    {
        $result = [];
        for ($i = 1; $i <= $index; $i++) {
            array_push($result, self::one($i, $profileType));
        }
        return $result;
    }

    public static function oneAdmin($index)
    {
        return self::one($index, GlobalConst::$PROFILE_TYPE["ADMIN"]["value"]);
    }

    public static function listAdmin($index)
    {
        return self::list($index, GlobalConst::$PROFILE_TYPE["ADMIN"]["value"]);
    }

    public static function oneStaff($index)
    {
        return self::one($index, GlobalConst::$PROFILE_TYPE["STAFF"]["value"]);
    }

    public static function listStaff($index)
    {
        return self::list($index, GlobalConst::$PROFILE_TYPE["STAFF"]["value"]);
    }
}
