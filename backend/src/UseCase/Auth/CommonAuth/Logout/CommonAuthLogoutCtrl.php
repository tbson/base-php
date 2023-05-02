<?php

namespace Src\UseCase\Auth\CommonAuth\Logout;

use Illuminate\Http\Request;
use Src\Util\CryptoUtil;
use Src\Service\Account\UserService;
use Src\UseCase\Auth\CommonAuth\Logout\CommonAuthLogoutFlow;

/**
 * Class CommonAuthLogoutCtrl
 * @package Src\UseCase\Auth\CommonAuth\Logout\CommonAuthLogoutCtrl
 */
class CommonAuthLogoutCtrl {
    public function logout(Request $request) {
        $jwtToken = CryptoUtil::getJwtTokenFromHeader($request->headers);
        $flow = new CommonAuthLogoutFlow(new UserService());
        $flow->logout($jwtToken);
        return response()->json([]);
    }

    public function refreshToken() {
        return response()->json([]);
    }

    public function refreshCheck() {
        return response()->json([]);
    }
}
