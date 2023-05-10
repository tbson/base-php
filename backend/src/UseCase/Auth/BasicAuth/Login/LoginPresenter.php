<?php

namespace Src\UseCase\Auth\BasicAuth\Login;

/*
 * @module Src\UseCase\Auth\BasicAuth\Login\LoginPresenter;
 */
class LoginPresenter {
    public static function presentLogin($user, $token) {
        return [
            "access_token" => $token,
            "user" => [
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "mobile" => $user->mobile,
                "profile_type" => $user->profile_type,
            ],
        ];
    }
}
