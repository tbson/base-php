<?php

namespace Src\UseCase\Auth\BasicAuth;

use Src\Interface\Account\UserServiceInterface;
use Src\Util\CryptoUtil;
use Src\Util\ErrorUtil;
use Src\UseCase\Auth\AuthHelper;

/*
 * @module Src\UseCase\Auth\BasicAuth\BasicAuthFlow;
 */
class BasicAuthFlow
{
    private $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function login($username, $password)
    {
        $error = ErrorUtil::parse("Invalid username or password");
        $user = $this->userService::getUser(["email" => $username]);
        if (!$user) {
            return ["error", $error];
        }
        if (!CryptoUtil::checkPwd($password, $user->password)) {
            return ["error", $error];
        }

        [$status, $result] = AuthHelper::generateUserToken($user->id);
        if ($status === "error") {
            return response()->json($result, 400);
        }
        $token = $result;

        return ["ok", [$user, $token]];
    }
}
