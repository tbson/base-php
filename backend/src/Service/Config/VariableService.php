<?php
namespace Src\Service\Config;
use Src\Interface\Config\Variable;
use Src\Service\Config\Schema\VariableSchema;
use Src\Service\DbService;

/**
 * @module Src\Service\Config\VariableService;
 */
class VariableService implements Variable {
    private static function getNotFoundMsg() {
        return __("Variable not found");
    }

    public static function getSchema() {
        return VariableSchema::class;
    }

    public static function getVariable($conditions) {
        return DbService::getItem(
            VariableSchema::class,
            $conditions,
            self::getNotFoundMsg(),
        );
    }

    public static function createVariable($attrs) {
        return DbService::createItem(VariableSchema::class, $attrs);
    }

    public static function updateVariable($conditions, $attrs) {
        return DbService::updateItem(VariableSchema::class, $conditions, $attrs);
    }

    public static function deleteVariable($conditions, $id) {
        return DbService::deleteItem(VariableSchema::class, $conditions, $id);
    }

    public static function deleteVariables($conditions, $ids) {
        return DbService::deleteItems(VariableSchema::class, $conditions, $ids);
    }
}
