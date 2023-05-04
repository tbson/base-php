<?php

namespace Src\UseCase\Account\Profile\UpdateProfile;

use Src\Interface\Account\User;

/*
 * @module Src\UseCase\Account\Profile\UpdateProfile\UpdateProfileFlow;
 */
class UpdateProfileFlow {
    private $userService;
    public function __construct(User $userService) {
        $this->userService = $userService;
    }

    public function updateProfile($id, $attrs) {
        $conditions = ["id" => $id];
        return $this->userService->updateUser($conditions, $attrs);
    }
}
