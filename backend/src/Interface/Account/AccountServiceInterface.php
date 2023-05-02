<?php

namespace Src\Interface\Account;
/**
 * Interface AccountServiceInterface
 * @package Src\Interface\Account\AccountServiceInterface
 */
interface AccountServiceInterface {
    public static function generateUserToken($userId);
}
