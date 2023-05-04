<?php

namespace Src\UseCase\Account\Profile\UpdateProfile;

use Illuminate\Http\Request;
use Src\Util\ResUtil;
use Src\Service\Account\UserService;
use Src\UseCase\Account\Profile\UpdateProfile\UpdateProfileFlow;
use Src\UseCase\Account\Profile\UpdateProfile\UpdateProfileValidator;
use Src\UseCase\Account\Profile\UpdateProfile\UpdateProfilePresenter;

/**
 * Class UpdateProfileCtrl
 * @package Src\UseCase\Account\Profile\UpdateProfile\UpdateProfileCtrl
 */
class UpdateProfileCtrl {
    public function updateProfile(Request $request) {
        $user = $request->user;
        $data = $request->all();
        [$status, $result] = UpdateProfileValidator::validateUpdateProfile($data);
        if ($status === "error") {
            return ResUtil::err($result);
        }
        $attrs = $result;

        $flow = new UpdateProfileFlow(new UserService());

        [$status, $result] = $flow->updateProfile($user->id, $attrs);
        if ($status === "error") {
            return ResUtil::err($result);
        }
        $user = $result;
        $response = UpdateProfilePresenter::presentUpdateProfile($user);

        return ResUtil::res($response);
    }
}
