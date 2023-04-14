<?php
namespace Prog\Srv\Config;

use Illuminate\Database\QueryException;
use Prog\Srv\Config\Schema\VariableSchema;
use Prog\Util\ErrorUtil;

/**
 * @module Prog\Srv\Config\VariableSrv;
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
