<?php

namespace Prog\Srv\Account;

use Prog\Srv\Account\Schema\UserSchema;

/**
 * @module Prog\Srv\Account\UserSrv;
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
