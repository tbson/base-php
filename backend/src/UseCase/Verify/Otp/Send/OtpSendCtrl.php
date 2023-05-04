<?php

namespace Src\UseCase\Verify\Otp\Send;

use Illuminate\Http\Request;
use Src\Controller;
use Src\Service\Account\UserService;
use Src\Service\Verify\OtpService;
use Src\Service\Noti\EmailService;
use Src\UseCase\Verify\Otp\Send\OtpSendFlow;
use Src\UseCase\Verify\Otp\Send\OtpSendPresenter;
use Src\UseCase\Verify\Otp\Send\OtpSendValidator;

/**
 * @module Src\UseCase\Verify\Otp\Send\OtpSendCtrl;
 */
class OtpSendCtrl extends Controller {
    public function send(Request $request) {
        [$status, $result] = OtpSendValidator::validateOtpSend($request->all());
        if ($status === "error") {
            return response()->json(["error" => $result], 400);
        }
        $target = $result["username"];
        $ips = [$request->ip()];
        $flow = new OtpSendFlow(
            new OtpService(),
            new UserService(),
            new EmailService(),
        );
        [$status, $result] = $flow->send($target, $ips);
        if ($status === "error") {
            return response()->json(["error" => $result], 400);
        }

        $otp = $result;
        $response = OtpSendPresenter::presentOtpSend($otp);

        return response()->json($response);
    }
}