<?php

namespace Src\UseCase\Auth\CommonAuth\RefreshToken;

/**
 * Class RefreshTokenPresenter
 * @package Src\UseCase\Auth\CommonAuth\RefreshToken
 */
class RefreshTokenPresenter {
    public static function presentRefreshToken($user, $token) {
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
