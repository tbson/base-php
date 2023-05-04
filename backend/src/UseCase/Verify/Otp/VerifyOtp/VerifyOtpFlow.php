<?php

namespace Src\UseCase\Verify\Otp\VerifyOtp;

use Src\Interface\Verify\Otp;

/**
 * @module Src\UseCase\Verify\Otp\VerifyOtp\VerifyOtpFlow;
 */
class VerifyOtpFlow {
    private $otpService;
    public function __construct(Otp $otpService) {
        $this->otpService = $otpService;
    }

    public function verifyOtp($id, $code) {
        [$status, $result] = $this->otpService::verifyOtp($id, $code);
        if ($status === "error") {
            return ["error", $result];
        }
        $otp = $result;
        return ["success", $otp];
    }
}
