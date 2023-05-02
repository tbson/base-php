<?php

namespace Src\Service\Account;

use Src\Util\ErrorUtil;
use Src\Util\CryptoUtil;
use Src\Service\Role\Schema\GroupSchema;
use Src\Interface\Account\AccountServiceInterface;
use Src\Service\Account\UserService;

/**
 * @module Src\Service\Account\AccountService;
 */
class AccountService implements AccountServiceInterface {
    private static function getUserPemIds($userId) {
        $user = UserService::getUser(["id" => $userId]);
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
                    ->toArray(),
            );
        }
        return ["ok", $pems];
    }

    public static function generateUserToken($userId) {
        [$status, $result] = self::getUserPemIds($userId);
        if ($status === "error") {
            return $result;
        }
        $pems = $result;
        return CryptoUtil::encodeJwt($userId, $pems);
    }
}
