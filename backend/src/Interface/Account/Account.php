<?php

namespace Src\Interface\Account;
/**
 * Interface Account
 * @package Src\Interface\Account\Account
 */
interface Account {
    public static function generateUserToken($userId);
}
