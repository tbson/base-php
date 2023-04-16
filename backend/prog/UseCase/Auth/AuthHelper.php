<?php
namespace Prog\UseCase\Auth;

use Prog\Srv\Role\Schema\GroupSchema;
use Prog\Srv\Account\Schema\UserSchema;

/**
 * Class AuthHelper
 * @package Prog\UseCase\Auth\AuthHelper
 */
class AuthHelper
{
    public static function getUserPemIds($userId)
    {
        $user = UserSchema::find($userId);
        if (is_null($user)) {
            return ["error", "User not found"];
        }
        $groupIds = json_decode($user->group_ids);
        $groups = GroupSchema::whereIn("id", $groupIds)->get();
        $pems = [];
        foreach ($groups as $group) {
            $pems = array_merge(
                $pems,
                $group
                    ->pem()
                    ->get()
                    ->pluck("id")
                    ->toArray()
            );
        }
        return $pems;
    }
}
