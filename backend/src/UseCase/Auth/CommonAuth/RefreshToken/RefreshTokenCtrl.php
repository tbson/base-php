<?php

namespace Src\UseCase\Auth\CommonAuth\RefreshToken;

use Illuminate\Http\Request;
use Src\Util\ResUtil;
use Src\Service\Account\AccountService;
use Src\Service\Account\UserService;
use Src\UseCase\Auth\CommonAuth\RefreshToken\RefreshTokenFlow;
use Src\UseCase\Auth\CommonAuth\RefreshToken\RefreshTokenValidator;
use Src\UseCase\Auth\CommonAuth\RefreshToken\RefreshTokenPresenter;

class RefreshTokenCtrl {
    public function refreshToken(Request $request) {
        $data = $request->all();
        [$status, $result] = RefreshTokenValidator::validateRefreshToken($data);
        if ($status === "error") {
            return ResUtil::err($result);
        }
        $token = $result["access_token"];
        $flow = new RefreshTokenFlow(new AccountService(), new UserService());

        [$status, $result] = $flow->refreshToken($token);
        if ($status === "error") {
            return ResUtil::err($result);
        }
        [$user, $token] = $result;
        $response = RefreshTokenPresenter::presentRefreshToken($user, $token);

        return ResUtil::res($response);
    }
}
