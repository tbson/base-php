<?php
namespace Prog\Srv\Org;

use Illuminate\Database\QueryException;
use Prog\Srv\Org\Schema\WorkspaceSchema;
use Prog\Util\ErrorUtil;

/**
 * @module Prog\Srv\Role\WorkspaceSrv;
 */
class WorkspaceSrv
{
    public static function createWrokspace($attrs)
    {
        try {
            return ["ok", WorkspaceSchema::create($attrs)];
        } catch (QueryException $e) {
            return ["error", ErrorUtil::parse($e->getMessage())];
        }
    }
}
