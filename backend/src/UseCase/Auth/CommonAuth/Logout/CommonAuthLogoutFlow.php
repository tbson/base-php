<?php

namespace Src\UseCase\Auth\CommonAuth\Logout;

use Src\Interface\Account\UserServiceInterface;
use Src\Util\CryptoUtil;
use Src\Util\ErrorUtil;

/*
 * @module Src\UseCase\Auth\CommonAuth\Logout\CommonAuthLogoutFlow;
 */
class CommonAuthLogoutFlow {
    private $userService;
    public function __construct(UserServiceInterface $userService) {
        $this->userService = $userService;
    }

    public function logout($jwtToken) {
        $error = ErrorUtil::parse("Can not logout properly");
        [$status, $result] = CryptoUtil::getJwtTerms($jwtToken);

        if ($status !== "ok") {
            return ["error", $error];
        }

        $userId = $result["user_id"];

        $user = $this->userService::getUser(["id" => $userId]);
        if ($user === null) {
            return ["error", $error];
        }
        $user->token_signature = "";
        $user->token_refresh_expired = null;
        $user->save();
        return ["ok", ""];
    }
}
