<?php

namespace Src\Service\Account\Seeder;
use Src\Service\Account\Schema\UserSchema;
use Src\Setting;

/**
 * @module Src\Service\Account\Seeder\UserSeeder;
 */
class UserSeeder {
    private static function data($index, $profileType) {
        $result = [
            "profile_type" => $profileType,
            "name" => "name {$index}",
            "email" => "test{$index}@gmail.com",
            "mobile" => "090669651{$index}",
            "password" => "password{$index}",
            "is_owner" => false,
        ];
        if ($profileType == Setting::PROFILE_TYPE["ADMIN"]) {
            $result["is_owner"] = true;
        }
        return $result;
    }

    private static function get_by($attr) {
        return UserSchema::where($attr)->first();
    }

    private static function create($attr) {
        return UserSchema::create($attr);
    }

    private static function one($index, $profileType) {
        $data = self::data($index, $profileType);
        $existItem = self::get_by($data);
        if ($existItem) {
            return $existItem;
        }
        return self::create($data);
    }

    private static function list($index, $profileType) {
        $result = [];
        for ($i = 1; $i <= $index; $i++) {
            array_push($result, self::one($i, $profileType));
        }
        return $result;
    }

    public static function oneAdmin($index) {
        return self::one($index, Setting::PROFILE_TYPE["ADMIN"]);
    }

    public static function listAdmin($index) {
        return self::list($index, Setting::PROFILE_TYPE["ADMIN"]);
    }

    public static function oneStaff($index) {
        return self::one($index, Setting::PROFILE_TYPE["STAFF"]);
    }

    public static function listStaff($index) {
        return self::list($index, Setting::PROFILE_TYPE["STAFF"]);
    }
}
