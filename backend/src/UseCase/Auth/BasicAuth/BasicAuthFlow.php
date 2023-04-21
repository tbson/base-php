<?php

namespace Src\UseCase\Auth\BasicAuth;

use Src\Interface\Account\UserServiceInterface;
use Src\Util\CryptoUtil;
use Src\Util\ErrorUtil;
use Src\Util\TimeUtil;

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

        # Check user exist
        $user = $this->userService::getUser(["email" => $username]);
        if (!$user) {
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
        [$status, $result] = $this->userService::generateUserToken($user->id);
        if ($status === "error") {
            return response()->json($result, 400);
        }
        $token = $result;

        # Write token_signature
        # Write token_refresh_expired -> now + JWT_REFRESH_PERIOD
        # Write last_login
        $tokenSignature = CryptoUtil::getTokenSignature($token);
        $user->token_signature = $tokenSignature;
        $JWT_REFRESH_PERIOD = env("JWT_REFRESH_PERIOD");
        $user->token_refresh_expired = TimeUtil::now()->modify(
            "+{$JWT_REFRESH_PERIOD} seconds"
        );
        $user->last_login = TimeUtil::now();
        $user->save();

        return ["ok", [$user, $token]];
    }
}
