<?php

namespace Src\UseCase\Auth\BasicAuth\ResetPwd;

/*
 * @module Src\UseCase\Auth\BasicAuth\ResetPwd\ResetPwdPresenter;
 */
class ResetPwdPresenter {
    public static function presentRequestResetPwd($otp) {
        return [
            "id" => $otp->id,
        ];
    }
    public static function presentConfirmResetPwd($user) {
        return [
            "ok" => true,
        ];
    }
}
