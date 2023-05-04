<?php

namespace Src\UseCase\Verify\Otp\Verify;

use Illuminate\Http\Request;
use Src\Controller;
use Src\Service\Verify\OtpService;
use Src\UseCase\Verify\Otp\Verify\VerifyOtpFlow;
use Src\UseCase\Verify\Otp\Verify\VerifyOtpValidator;
use Src\UseCase\Verify\Otp\Verify\VerifyOtpPresenter;

/**
 * @module Src\UseCase\Verify\Otp\Verify\VerifyOtpCtrl;
 */
class VerifyOtpCtrl extends Controller {
    public function verifyOtp(Request $request) {
        [$status, $result] = VerifyOtpValidator::validateVerifyOtp($request->all());
        if ($status === "error") {
            return response()->json(["error" => $result], 400);
        }

        $id = $result["id"];
        $code = $result["code"];
        $flow = new VerifyOtpFlow(new OtpService());
        [$status, $result] = $flow->verifyOtp($id, $code);
        if ($status === "error") {
            return response()->json(["error" => $result], 400);
        }

        $otp = $result;

        $response = VerifyOtpPresenter::presentVerifyOtp($otp);

        return response()->json($response);
    }
}
