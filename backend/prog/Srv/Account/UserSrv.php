<?php

namespace Prog\Srv\Account;

use Prog\Srv\Account\Schema\UserSchema;
use Prog\Util\CryptoUtil;

class UserSrv
{
    public static function getAllUsers()
    {
        return UserSchema::all();
    }

    public static function generateUserToken($userId)
    {
        $user = UserSchema::find($userId);
        if (is_null($user)) {
            return ["error", "User not found"];
        }
        $pems = $user->pems->pluck("id")->toArray();
        return CryptoUtil::encode($userId, $pems);
    }
}
