<?php

namespace Src\UseCase\Verify\Otp\SendOtp;
use Src\Interface\Account\User;
use Src\Interface\Verify\Otp;
use Src\Interface\Noti\Email;
use Src\Util\ErrorUtil;
use Src\Util\CryptoUtil;

/**
 * @module Src\UseCase\Verify\Otp\Send\SendOtpFlow;
 */
class SendOtpFlow {
    private $otpService;
    private $userService;
    private $emailService;
    public function __construct(
        Otp $otpService,
        User $userService,
        Email $emailService,
    ) {
        $this->otpService = $otpService;
        $this->userService = $userService;
        $this->emailService = $emailService;
    }

    public function sendOtp($target, $ips, $extraData = []) {
        $error = ErrorUtil::parse(__("Fail to send OTP"));

        [$status, $_user] = $this->userService::getUser(["email" => $target]);
        if (!$status) {
            return ["success", CryptoUtil::generateUuid()];
        }

        $isAllow = $this->otpService::isAllowToCreateOtp($target, $ips);
        if (!$isAllow) {
            return ["error", $error];
        }

        [$status, $result] = $this->otpService::createOtp($target, $ips, $extraData);
        if ($status === "error") {
            return ["error", $result];
        }

        $otp = $result;
        [$recipients, $subject, $body] = $this->otpService::getOtpEmailInput($otp);
        $this->emailService::sendEmailAsync($recipients, $subject, $body);

        return ["success", $otp];
    }
}
