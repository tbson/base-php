<?php

namespace Src\UseCase\Auth\BasicAuth\ResetPwd;

use Src\Interface\Account\User;
use Src\Interface\Verify\Otp;
use Src\Interface\Noti\Email;
use Src\Util\ErrorUtil;
use Src\UseCase\Verify\Otp\SendOtp\SendOtpFlow;
use Src\UseCase\Verify\Otp\VerifyOtp\VerifyOtpFlow;

/*
 * @module Src\UseCase\Auth\BasicAuth\ResetPwd\ResetPwdFlow;
 */
class ResetPwdFlow {
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

    public function requestResetPwd($username, $ips) {
        $sendOtpFlow = new SendOtpFlow(
            $this->otpService,
            $this->userService,
            $this->emailService,
        );
        return $sendOtpFlow->sendOtp($username, $ips);
    }

    public function confirmResetPwd(
        $username,
        $password,
        $passwordConfirm,
        $otpId,
        $otpCode,
    ) {
        if ($password !== $passwordConfirm) {
            return [
                "error",
                ErrorUtil::parse(__("Password and confirm password are not matched")),
            ];
        }

        [$status, $result] = $this->userService::getUser(["email" => $username]);
        if (!$status) {
            return ["error", $result];
        }
        $user = $result;

        $verifyOtpFlow = new VerifyOtpFlow($this->otpService);
        [$status, $result] = $verifyOtpFlow->verifyOtp($otpId, $otpCode);
        if ($status === "error") {
            return ["error", $result];
        }

        $user->password = $password;
        $user->save();
        return ["success", $user];
    }
}
