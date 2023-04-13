<?php

namespace Src\Service\Account;

use Src\Service\Account\Schema\UserSchema;

class UserService
{
    public static function getAllUsers()
    {
        return UserSchema::all();
    }
}
