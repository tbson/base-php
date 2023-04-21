<?php

namespace Src\Service\Account;

use Src\Interface\Account\UserServiceInterface;
use Src\Util\ErrorUtil;
use Src\Util\CryptoUtil;
use Src\Service\Account\Schema\UserSchema;
use Src\Service\Role\Schema\GroupSchema;

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

    private static function getUserPemIds($userId)
    {
        $user = self::getUser(["id" => $userId]);
        if (is_null($user)) {
            return ["error", ErrorUtil::parse("User not found")];
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
        return ["ok", $pems];
    }

    public static function generateUserToken($userId)
    {
        [$status, $result] = self::getUserPemIds($userId);
        if ($status === "error") {
            return $result;
        }
        $pems = $result;
        return CryptoUtil::encodeJwt($userId, $pems);
    }
}
