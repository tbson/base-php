<?php

namespace Src\UseCase\Role\Group\Crud;

use Src\Interface\Role\Group;

/*
 * @module Src\UseCase\Role\Group\Crud\CrudGroupFlow;
 */
class CrudGroupFlow {
    private $groupService;
    public function __construct(Group $groupService) {
        $this->groupService = $groupService;
    }

    public function list($conditions = []) {
        $schema = $this->groupService->getSchema();
        if (!empty($conditions)) {
            return $schema::where($conditions);
        }
        return $schema::query();
    }

    public function retrieve($id) {
        $conditions = ["id" => $id];
        return $this->groupService->getGroup($conditions);
    }

    public function create($attrs) {
        $pems = $attrs["pems"];
        [$status, $group] = $this->groupService->createGroup($attrs);
        $group->pems()->syncWithoutDetaching($pems);
        return [$status, $group];
    }

    public function update($id, $attrs) {
        $conditions = ["id" => $id];
        $pems = $attrs["pems"];
        [$status, $group] = $this->groupService->updateGroup($conditions, $attrs);
        if (!$group->default) {
            $group->pems()->sync($pems);
        }
        return [$status, $group];
    }

    public function delete($id) {
        return $this->groupService->deleteGroup([], $id);
    }

    public function deleteList($ids) {
        return $this->groupService->deleteGroups([], $ids);
    }
}
