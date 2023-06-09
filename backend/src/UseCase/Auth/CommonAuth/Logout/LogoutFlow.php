<?php

namespace Src\UseCase\Auth\CommonAuth\Logout;

use Src\Interface\Account\User;
use Src\Util\CryptoUtil;
use Src\Util\ErrorUtil;

/*
 * @module Src\UseCase\Auth\CommonAuth\Logout\LogoutFlow;
 */
class LogoutFlow {
    private $userService;
    public function __construct(User $userService) {
        $this->userService = $userService;
    }

    public function logout($jwtToken) {
        $error = ErrorUtil::parse("Can not logout properly");
        [$status, $result] = CryptoUtil::getJwtTerms($jwtToken);

        if ($status !== "ok") {
            return ["error", $error];
        }

        $userId = $result["user_id"];

        [$status, $user] = $this->userService::getUser(["id" => $userId]);
        if ($status === "error") {
            return ["error", $error];
        }
        $user->token_signature = "";
        $user->token_refresh_expired = null;
        $user->save();
        return ["ok", ""];
    }
}
