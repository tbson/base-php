<?php

namespace Src\UseCase\Auth\CommonAuth\RefreshToken;

use Src\Interface\Account\Account;
use Src\Interface\Account\User;
use Src\Util\TimeUtil;
use Src\Util\CryptoUtil;
use Src\Util\ErrorUtil;

/**
 * @module Src\UseCase\Auth\CommonAuth\RefreshToken\RefreshTokenFlow;
 */
class RefreshTokenFlow {
    private $accountService;
    private $userService;

    public function __construct(Account $accountService, User $userService) {
        $this->accountService = $accountService;
        $this->userService = $userService;
    }

    public function refreshToken($token) {
        $error = ErrorUtil::parse(__("Can not refresh token"));
        # Check corresponding user using token_signature
        $tokenSignature = CryptoUtil::getTokenSignature($token);
        [$status, $result] = $this->userService::getUser([
            "token_signature" => $tokenSignature,
        ]);
        if ($status === "error") {
            return ["error", $error];
        }
        $user = $result;

        # Check token_refresh_expired
        $tokenRefreshExpired = TimeUtil::strToDatetime($user->token_refresh_expired);
        if (TimeUtil::isExpired($tokenRefreshExpired)) {
            return ["error", $error];
        }

        # Generate new token
        [$status, $result] = $this->accountService::generateUserToken($user->id);
        if ($status === "error") {
            return ["error", $error];
        }

        # Update metadata after getting token
        $token = $result;
        $user = $this->userService::updateAfterAuth($user, $token, false);

        return ["ok", [$user, $token]];
    }
}
