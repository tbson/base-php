<?php

namespace Src\UseCase\Verify\Otp\SendOtp;

use Illuminate\Http\Request;
use Src\Util\ResUtil;
use Src\Controller;
use Src\Service\Account\UserService;
use Src\Service\Verify\OtpService;
use Src\Service\Noti\EmailService;
use Src\UseCase\Verify\Otp\SendOtp\SendOtpFlow;
use Src\UseCase\Verify\Otp\SendOtp\SendOtpPresenter;
use Src\UseCase\Verify\Otp\SendOtp\SendOtpValidator;

/**
 * @module Src\UseCase\Verify\Otp\Send\SendOtpCtrl;
 */
class SendOtpCtrl extends Controller {
    public function sendOtp(Request $request) {
        [$status, $result] = SendOtpValidator::validateSendOtp($request->all());
        if ($status === "error") {
            return ResUtil::err($result);
        }
        $target = $result["username"];
        $ips = [$request->ip()];
        $flow = new SendOtpFlow(
            new OtpService(),
            new UserService(),
            new EmailService(),
        );
        [$status, $result] = $flow->sendOtp($target, $ips);
        if ($status === "error") {
            return ResUtil::err($result);
        }

        $otp = $result;
        $response = SendOtpPresenter::presentSendOtp($otp);

        return ResUtil::res($response);
    }
}
