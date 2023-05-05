<?php

namespace Src\UseCase\Config\Variable\Crud;

use Src\Interface\Config\Variable;

/*
 * @module Src\UseCase\Config\Variable\Crud\CrudVariableFlow;
 */
class CrudVariableFlow {
    private $variableService;
    public function __construct(Variable $variableService) {
        $this->variableService = $variableService;
    }

    public function list($conditions = []) {
        $schema = $this->variableService->getSchema();
        if (!empty($conditions)) {
            return $schema::where($conditions);
        }
        return $schema::query();
    }

    public function retrieve($id) {
        $conditions = ["id" => $id];
        return $this->variableService->getVariable($conditions);
    }

    public function create($attrs) {
        return $this->variableService->createVariable($attrs);
    }

    public function update($id, $attrs) {
        $conditions = ["id" => $id];
        return $this->variableService->updateVariable($conditions, $attrs);
    }

    public function delete($id) {
        return $this->variableService->deleteVariable([], $id);
    }

    public function deleteList($ids) {
        return $this->variableService->deleteVariables([], $ids);
    }
}
