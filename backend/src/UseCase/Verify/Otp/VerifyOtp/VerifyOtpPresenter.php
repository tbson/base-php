<?php

namespace Src\UseCase\Verify\Otp\VerifyOtp;

/**
 * @module Src\UseCase\Verify\Otp\Verify\VerifyOtpPresenter;
 */
class VerifyOtpPresenter {
    public static function presentVerifyOtp($otp) {
        return [
            "ok" => true,
        ];
    }
}
