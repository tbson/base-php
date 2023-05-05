<?php

namespace Src\UseCase\Auth\BasicAuth\ChangePwd;

use Illuminate\Http\Request;
use Src\Util\ResUtil;
use Src\UseCase\Auth\BasicAuth\ChangePwd\ChangePwdFlow;
use Src\UseCase\Auth\BasicAuth\ChangePwd\ChangePwdValidator;
use Src\UseCase\Auth\BasicAuth\ChangePwd\ChangePwdPresenter;

/**
 * Class ChangePwdCtrl
 * @package Src\UseCase\Auth\BasicAuth\ChangePwd\ChangePwdCtrl
 */
class ChangePwdCtrl {
    public function changePwd(Request $request) {
        $user = $request->get("user");
        $data = $request->all();
        [$status, $result] = ChangePwdValidator::validateChangePwd($data);
        if ($status === "error") {
            return ResUtil::err($result);
        }
        $password = $result["password"];
        $newPassword = $result["new_password"];
        $newPasswordConfirm = $result["new_password_confirm"];
        $flow = new ChangePwdFlow();

        [$status, $result] = $flow->changePwd(
            $user,
            $password,
            $newPassword,
            $newPasswordConfirm,
        );
        if ($status === "error") {
            return ResUtil::err($result);
        }
        $user = $result;
        $response = ChangePwdPresenter::presentChangePwd($user);

        return ResUtil::res($response);
    }
}
