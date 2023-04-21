<?php

namespace Src\Service\Account;

use Src\Service\Account\Schema\UserSchema;
use Src\Interface\Account\UserServiceInterface;

/**
 * @module Src\Service\Account\UserService;
 */
class UserService implements UserServiceInterface
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
