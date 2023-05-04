<?php

namespace Src\UseCase\Verify\Otp\SendOtp;

/**
 * @module Src\UseCase\Verify\Otp\Send\SendOtpPresenter;
 */
class SendOtpPresenter {
    public static function presentSendOtp($otp) {
        return [
            "id" => $otp->id,
        ];
    }
}
