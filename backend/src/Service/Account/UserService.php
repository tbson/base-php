<?php

namespace Src\Service\Account;

use Src\Interface\Account\User;
use Src\Setting;
use Src\Util\CryptoUtil;
use Src\Util\TimeUtil;
use Src\Service\Account\Schema\UserSchema;
use Src\Service\DbService;

/**
 * @module Src\Service\Account\UserService;
 */
class UserService implements User {
    private static function getNotFoundMsg() {
        return __("User not found");
    }

    public static function getUser($conditions) {
        return DbService::getItem(
            UserSchema::class,
            $conditions,
            self::getNotFoundMsg(),
        );
    }

    public static function createUser($attrs) {
        return DbService::createItem(UserSchema::class, $attrs);
    }

    public static function updateUser($conditions, $attrs) {
        return DbService::updateItem(UserSchema::class, $conditions, $attrs);
    }

    public static function deleteUser($conditions, $id) {
        return DbService::deleteItem(UserSchema::class, $conditions, $id);
    }

    public static function deleteUsers($conditions, $ids) {
        return DbService::deleteItems(UserSchema::class, $conditions, $ids);
    }

    public static function updateAfterAuth($user, $token, $updateLastLogin = true) {
        $tokenSignature = CryptoUtil::getTokenSignature($token);
        $user->token_signature = $tokenSignature;
        $refreshPeriod = Setting::JWT_REFRESH_PERIOD;
        $user->token_refresh_expired = TimeUtil::now()->modify(
            "+{$refreshPeriod} seconds",
        );
        if ($updateLastLogin) {
            $user->last_login = TimeUtil::now();
        }
        $user->save();
        return $user;
    }
}
