<?php

namespace Src\Interface\Account;
/**
 * Interface UserServiceInterface
 * @package Src\Interface\Account\UserServiceInterface
 */
interface UserServiceInterface
{
    public static function getAllUsers();
    public static function getUser($conditions);
    public static function generateUserToken($userId);
}
