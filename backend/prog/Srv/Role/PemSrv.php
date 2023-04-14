<?php
namespace Prog\Srv\Role;

use Illuminate\Database\QueryException;
use Prog\Srv\Role\Schema\PemSchema;
use Prog\Util\ErrorUtil;

/**
 * @module Prog\Srv\Role\PemSrv;
 */
class PemSrv
{
    public static function createPem($attrs)
    {
        try {
            return [true, PemSchema::create($attrs)];
        } catch (QueryException $e) {
            return ["error", ErrorUtil::parse($e->getMessage())];
        }
    }
}
