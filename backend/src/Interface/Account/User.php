<?php

namespace Src\Interface\Account;
/**
 * Interface User
 * @package Src\Interface\Account\User
 */
interface User {
    public static function getUser($conditions);
    public static function updateAfterAuth($user, $token);
}
