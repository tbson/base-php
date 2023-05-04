<?php

namespace Src\UseCase\Auth\CommonAuth\Logout;

use Illuminate\Http\Request;
use Src\Util\ResUtil;
use Src\Util\CryptoUtil;
use Src\Service\Account\UserService;
use Src\UseCase\Auth\CommonAuth\Logout\LogoutFlow;

/**
 * Class LogoutCtrl
 * @package Src\UseCase\Auth\CommonAuth\Logout\LogoutCtrl
 */
class LogoutCtrl {
    public function logout(Request $request) {
        $jwtToken = CryptoUtil::getJwtTokenFromHeader($request->headers);
        $flow = new LogoutFlow(new UserService());
        $flow->logout($jwtToken);
        return ResUtil::res([]);
    }
}
