<?php

namespace Src\UseCase\Verify\Otp\Verify;

use Illuminate\Http\Request;
use Src\Controller;
use Src\Service\Verify\OtpService;
use Src\UseCase\Verify\Otp\Verify\OtpVerifyFlow;
use Src\UseCase\Verify\Otp\Verify\OtpVerifyValidator;

/**
 * @module Src\UseCase\Verify\Otp\Verify\OtpVerifyCtrl;
 */
class OtpVerifyCtrl extends Controller {
    public function send(Request $request) {
        [$status, $result] = OtpVerifyValidator::validateOtpVerify($request->all());
        if ($status === "error") {
            return response()->json(["error" => $result], 400);
        }

        $id = $result["id"];
        $code = $result["code"];
        $flow = new OtpVerifyFlow(new OtpService());
        [$status, $result] = $flow->verify($id, $code);
        if ($status === "error") {
            return response()->json(["error" => $result], 400);
        }

        $response = ["ok" => true];

        return response()->json($response);
    }
}
