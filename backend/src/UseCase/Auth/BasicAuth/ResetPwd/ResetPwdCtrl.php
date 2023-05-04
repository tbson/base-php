<?php

namespace Src\UseCase\Auth\BasicAuth\ResetPwd;

use Illuminate\Http\Request;
use Src\Util\ResUtil;

use Src\Service\Account\UserService;
use Src\Service\Verify\OtpService;
use Src\Service\Noti\EmailService;

use Src\UseCase\Auth\BasicAuth\ResetPwd\ResetPwdFlow;
use Src\UseCase\Auth\BasicAuth\ResetPwd\ResetPwdValidator;
use Src\UseCase\Auth\BasicAuth\ResetPwd\ResetPwdPresenter;

/**
 * Class ResetPwdCtrl
 * @package Src\UseCase\Auth\BasicAuth\ResetPwd\ResetPwdCtrl
 */
class ResetPwdCtrl {
    public function requestResetPwd(Request $request) {
        $data = $request->all();
        [$status, $result] = ResetPwdValidator::validateRequestResetPwd($data);
        if ($status === "error") {
            return ResUtil::err($result);
        }
        $username = $result["username"];
        $ips = [$request->ip()];
        $flow = new ResetPwdFlow(
            new OtpService(),
            new UserService(),
            new EmailService(),
        );

        [$status, $result] = $flow->requestResetPwd($username, $ips);
        if ($status === "error") {
            return ResUtil::err($result);
        }
        $otp = $result;

        $response = ResetPwdPresenter::presentRequestResetPwd($otp);

        return ResUtil::res($response);
    }

    public function confirmResetPwd(Request $request) {
        $data = $request->all();
        [$status, $result] = ResetPwdValidator::validateConfirmResetPwd($data);
        if ($status === "error") {
            return ResUtil::err($result);
        }
        $username = $result["username"];
        $password = $result["password"];
        $passwordConfirm = $result["password_confirm"];
        $otpId = $result["otp_id"];
        $otpCode = $result["otp_code"];
        $flow = new ResetPwdFlow(
            new OtpService(),
            new UserService(),
            new EmailService(),
        );

        [$status, $result] = $flow->confirmResetPwd(
            $username,
            $password,
            $passwordConfirm,
            $otpId,
            $otpCode,
        );
        if ($status === "error") {
            return ResUtil::err($result);
        }
        $user = $result;

        $response = ResetPwdPresenter::presentConfirmResetPwd($user);

        return ResUtil::res($response);
    }
}
