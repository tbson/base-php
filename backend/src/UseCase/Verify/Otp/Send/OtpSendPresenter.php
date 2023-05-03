<?php

namespace Src\UseCase\Verify\Otp\Send;

/**
 * @module Src\UseCase\Verify\Otp\Send\OtpSendPresenter;
 */
class OtpSendPresenter {
    public static function presentOtpSend($otp) {
        return [
            "id" => $otp->id,
        ];
    }
}
