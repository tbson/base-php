<?php

namespace Src\Service\Account;

use Illuminate\Database\Eloquent\Builder;
use Src\Util\ErrorUtil;
use Src\Util\CryptoUtil;
use Src\Service\Role\Schema\PemSchema;
use Src\Interface\Account\Account;
use Src\Service\Account\UserService;

/**
 * @module Src\Service\Account\AccountService;
 */
class AccountService implements Account {
    private static function getUserPemIds($userId) {
        [$status, $user] = UserService::getUser(["id" => $userId]);
        if ($status === "error") {
            return ["error", ErrorUtil::parse("User not found")];
        }
        $groupIds = $user->group_ids;
        $pems = PemSchema::whereHas("groups", function (Builder $query) use (
            $groupIds,
        ) {
            $query->whereIn("group_id", $groupIds);
        })
            ->pluck("id")
            ->unique()
            ->toArray();

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
