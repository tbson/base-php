<?php

namespace Prog\Srv\Account;

use Prog\Srv\Account\Schema\UserSchema;

class UserSrv
{
    public static function getAllUsers()
    {
        return UserSchema::all();
    }
}
