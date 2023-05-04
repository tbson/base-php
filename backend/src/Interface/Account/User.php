<?php

namespace Src\Interface\Account;
/**
 * Interface User
 * @package Src\Interface\Account\User
 */
interface User {
    public static function getUser($conditions);
    public static function createUser($attrs);
    public static function updateUser($conditions, $attrs);
    public static function deleteUser($conditions, $id);
    public static function deleteUsers($conditions, $ids);
    public static function updateAfterAuth($user, $token);
}
