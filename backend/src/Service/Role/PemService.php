<?php
namespace Src\Service\Role;

use Illuminate\Database\QueryException;
use Src\Service\Role\Schema\PemSchema;
use Src\Util\ErrorUtil;

/**
 * @module Src\Service\Role\PemService;
 */
class PemService {
    public static function getPem($conditions) {
        return PemSchema::where($conditions)->first();
    }

    public static function createPem($attrs) {
        try {
            return [true, PemSchema::create($attrs)];
        } catch (QueryException $e) {
            return ["error", ErrorUtil::parse($e->getMessage())];
        }
    }
}
