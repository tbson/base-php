<?php

namespace Src\UseCase\Account\Profile\UpdateProfile;

/*
 * @module Src\UseCase\Account\Profile\UpdateProfile\UpdateProfilePresenter;
 */
class UpdateProfilePresenter {
    public static function presentUpdateProfile($user) {
        return [
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "mobile" => $user->mobile,
        ];
    }
}
