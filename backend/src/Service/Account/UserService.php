<?php

namespace Src\Service\Account;

use Src\Interface\Account\User;
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
}
