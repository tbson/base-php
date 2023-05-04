<?php

namespace Src\UseCase\Account\Profile\GetProfile;

/*
 * @module Src\UseCase\Account\Profile\GetProfile\GetProfilePresenter;
 */
class GetProfilePresenter {
    public static function presentGetProfile($user) {
        return [
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "mobile" => $user->mobile,
        ];
    }
}
