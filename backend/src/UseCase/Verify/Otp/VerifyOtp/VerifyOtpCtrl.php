<?php

namespace Src\UseCase\Verify\Otp\VerifyOtp;

use Illuminate\Http\Request;
use Src\Util\ResUtil;
use Src\Controller;
use Src\Service\Verify\OtpService;
use Src\UseCase\Verify\Otp\VerifyOtp\VerifyOtpFlow;
use Src\UseCase\Verify\Otp\VerifyOtp\VerifyOtpValidator;
use Src\UseCase\Verify\Otp\VerifyOtp\VerifyOtpPresenter;

/**
 * @module Src\UseCase\Verify\Otp\Verify\VerifyOtpCtrl;
 */
class VerifyOtpCtrl extends Controller {
    public function verifyOtp(Request $request) {
        [$status, $result] = VerifyOtpValidator::validateVerifyOtp($request->all());
        if ($status === "error") {
            return ResUtil::err($result);
        }

        $id = $result["id"];
        $code = $result["code"];
        $flow = new VerifyOtpFlow(new OtpService());
        [$status, $result] = $flow->verifyOtp($id, $code);
        if ($status === "error") {
            return ResUtil::err($result);
        }

        $otp = $result;

        $response = VerifyOtpPresenter::presentVerifyOtp($otp);

        return ResUtil::res($response);
    }
}
