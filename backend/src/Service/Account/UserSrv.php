<?php

namespace Src\Service\Account;

use Src\Service\Account\Schema\UserSchema;

/**
 * @module Src\Service\Account\UserSrv;
 */
class UserSrv
{
    public static function getAllUsers()
    {
        return UserSchema::all();
    }

    public static function getUser($conditions)
    {
        return UserSchema::where($conditions)->first();
    }
}
