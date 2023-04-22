<?php

namespace Src\UseCase\Auth\BasicAuth;

/*
 * @module Src\UseCase\Auth\BasicAuth\BasicAuthPresenter;
 */
class BasicAuthPresenter
{
    public static function presentLogin($user, $token)
    {
        return [
            "access_token" => $token,
            "user" => [
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "mobile" => $user->mobile,
            ],
        ];
    }
}
