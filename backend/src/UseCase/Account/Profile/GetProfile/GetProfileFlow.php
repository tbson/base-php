<?php

namespace Src\UseCase\Account\Profile\GetProfile;

use Src\Interface\Account\User;

/*
 * @module Src\UseCase\Account\Profile\GetProfile\GetProfileFlow;
 */
class GetProfileFlow {
    private $userService;
    public function __construct(User $userService) {
        $this->userService = $userService;
    }

    public function getProfile($id) {
        $conditions = ["id" => $id];
        return $this->userService->getUser($conditions);
    }
}
