<?php
namespace Src\Service\Config;

use Illuminate\Database\QueryException;
use Src\Service\Config\Schema\VariableSchema;
use Src\Util\ErrorUtil;

/**
 * @module Src\Service\Config\VariableSrv;
 */
class VariableSrv
{
    public static function createVariable($attrs)
    {
        try {
            return [true, VariableSchema::create($attrs)];
        } catch (QueryException $e) {
            return ["error", ErrorUtil::parse($e->getMessage())];
        }
    }
}
