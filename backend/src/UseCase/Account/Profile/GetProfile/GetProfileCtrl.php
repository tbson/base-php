<?php

namespace Src\UseCase\Account\Profile\GetProfile;

use Illuminate\Http\Request;
use Src\Util\ResUtil;
use Src\Service\Account\UserService;
use Src\UseCase\Account\Profile\GetProfile\GetProfileFlow;
use Src\UseCase\Account\Profile\GetProfile\GetProfilePresenter;

/**
 * Class GetProfileCtrl
 * @package Src\UseCase\Account\Profile\GetProfile\GetProfileCtrl
 */
class GetProfileCtrl {
    public function getProfile(Request $request) {
        $user = $request->user;

        $flow = new GetProfileFlow(new UserService());

        [$status, $result] = $flow->getProfile($user->id);
        if ($status === "error") {
            return ResUtil::err($result);
        }
        $user = $result;
        $response = GetProfilePresenter::presentGetProfile($user);

        return ResUtil::res($response);
    }
}
