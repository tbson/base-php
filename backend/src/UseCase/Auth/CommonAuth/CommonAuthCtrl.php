<?php

namespace Src\UseCase\Auth\CommonAuth;

use Illuminate\Http\Request;
use Src\Util\CryptoUtil;
use Src\Service\Account\UserService;
use Src\UseCase\Auth\CommonAuth\CommonAuthFlow;

/**
 * Class CommonAuthCtrl
 * @package Src\UseCase\Auth\CommonAuth\CommonAuthCtrl
 */
class CommonAuthCtrl
{
    public function logout(Request $request)
    {
        $jwtToken = CryptoUtil::getJwtTokenFromHeader($request->headers);
        $flow = new CommonAuthFlow(new UserService());
        $flow->logout($jwtToken);
        return response()->json([]);
    }
}
