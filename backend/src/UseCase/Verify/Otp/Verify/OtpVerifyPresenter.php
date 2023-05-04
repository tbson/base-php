<?php

namespace Src\UseCase\Verify\Otp\Verify;

/**
 * @module Src\UseCase\Verify\Otp\Verify\OtpVerifyPresenter;
 */
class OtpVerifyPresenter {
    public static function presentOtpVerify($otp) {
        return [
            "ok" => true,
        ];
    }
}
