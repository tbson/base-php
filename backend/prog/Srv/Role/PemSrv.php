<?php
namespace Prog\Srv\Role;

use Illuminate\Database\QueryException;
use Prog\Srv\Role\Schema\PemSchema;

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
            $errorMessage = $e->getMessage();
            return [false, ["detail" => [$errorMessage]]];
        }
    }
}
