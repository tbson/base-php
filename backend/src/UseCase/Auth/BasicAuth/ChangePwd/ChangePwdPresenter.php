<?php

namespace Src\UseCase\Auth\BasicAuth\ChangePwd;

/*
 * @module Src\UseCase\Auth\BasicAuth\ChangePwd\ChangePwdPresenter;
 */
class ChangePwdPresenter {
    public static function presentChangePwd($user) {
        return [
            "ok" => true,
        ];
    }
}
