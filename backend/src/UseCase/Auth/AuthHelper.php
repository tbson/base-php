<?php
namespace Src\UseCase\Auth;

use Src\Service\Role\Schema\GroupSchema;
use Src\Service\Account\Schema\UserSchema;

/**
 * Class AuthHelper
 * @package Src\UseCase\Auth\AuthHelper
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
