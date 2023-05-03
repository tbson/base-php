<?php

namespace Src\UseCase\Verify\Otp\Send;

use Illuminate\Http\Request;
use Src\Controller;
use Src\UseCase\Verify\Otp\Send\OtpSendFlow;
use Src\Service\Account\UserService;
use Src\Service\Verify\OtpService;
use Src\Service\Noti\EmailService;

/**
 * @module Src\UseCase\Verify\Otp\Send\OtpSendCtrl;
 */
class OtpSendCtrl extends Controller {
    public function send(Request $request) {
        $target = $request->input("username");
        $ips = [$request->ip()];
        $flow = new OtpSendFlow(
            new OtpService(),
            new UserService(),
            new EmailService(),
        );
        [$status, $result] = $flow->send($target, $ips);
        if ($status === "error") {
            return response()->json(["error" => $result]);
        }

        $otpId = $result;

        return response()->json(["id" => $otpId]);
    }
}
