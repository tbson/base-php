<?php

namespace Src\UseCase\Account\User\Crud;

use Src\Interface\Account\User;

/*
 * @module Src\UseCase\Account\User\Crud\CrudUserFlow;
 */
class CrudUserFlow {
    private $userService;
    public function __construct(User $userService) {
        $this->userService = $userService;
    }

    public function list($conditions = []) {
        $schema = $this->userService->getSchema();
        if (!empty($conditions)) {
            return $schema::where($conditions);
        }
        return $schema::query();
    }

    public function retrieve($id) {
        $conditions = ["id" => $id];
        return $this->userService->getUser($conditions);
    }

    public function create($attrs) {
        return $this->userService->createUser($attrs);
    }

    public function update($id, $attrs) {
        $conditions = ["id" => $id];
        return $this->userService->updateUser($conditions, $attrs);
    }

    public function delete($id) {
        return $this->userService->deleteUser([], $id);
    }

    public function deleteList($ids) {
        return $this->userService->deleteUsers([], $ids);
    }
}
