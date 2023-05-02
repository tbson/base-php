<?php
namespace Src\Service\Config;

use Illuminate\Database\QueryException;
use Src\Service\Config\Schema\VariableSchema;
use Src\Util\ErrorUtil;

/**
 * @module Src\Service\Config\VariableService;
 */
class VariableService {
    private static $notFoundMsg = __("Variable not found");

    public static function getVariable($conditions) {
        $result = VariableSchema::where($conditions)->first();
        if ($result === null) {
            return ["error", ErrorUtil::parse(self::$notFoundMsg)];
        }
        return ["ok", $result];
    }

    public static function createVariable($attrs) {
        try {
            return [true, VariableSchema::create($attrs)];
        } catch (QueryException $e) {
            return ["error", ErrorUtil::parse($e->getMessage())];
        }
    }

    public static function updateVariable($conditions, $attrs) {
    }

    public static function deleteVariable($conditions, $id) {
    }

    public static function deleteVariables($conditions, $ids) {
    }
}
