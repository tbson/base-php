<?php

namespace Src\UseCase\Auth\BasicAuth\Login;

use Src\Interface\Account\Account;
use Src\Interface\Account\User;
use Src\Util\CryptoUtil;
use Src\Util\ErrorUtil;

/*
 * @module Src\UseCase\Auth\BasicAuth\Login\LoginFlow;
 */
class LoginFlow {
    private $accountService;
    private $userService;
    public function __construct(Account $accountService, User $userService) {
        $this->accountService = $accountService;
        $this->userService = $userService;
    }

    public function login($username, $password) {
        $error = ErrorUtil::parse("Invalid username or password");

        # Check user exist
        [$status, $user] = $this->userService::getUser(["email" => $username]);
        if ($status === "error") {
            return ["error", $error];
        }

        # Check user enabled
        if (!$user->enabled) {
            return ["error", $error];
        }

        # Check password match
        if (!CryptoUtil::checkPwd($password, $user->password)) {
            return ["error", $error];
        }

        # Generate token
        [$status, $result] = $this->accountService::generateUserToken($user->id);
        if ($status === "error") {
            return ["error", $error];
        }
        $token = $result;

        $user = $this->userService::updateAfterAuth($user, $token);

        return ["ok", [$user, $token]];
    }
}
