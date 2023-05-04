<?php
namespace Src\Service\Role;

use Illuminate\Database\QueryException;
use Src\Service\Role\Schema\PemSchema;
use Src\Service\DbService;
use Src\Util\ErrorUtil;

/**
 * @module Src\Service\Role\PemService;
 */
class PemService {
    private static function getNotFoundMsg() {
        return __("Permission not found");
    }

    public static function getPem($conditions) {
        return DbService::getItem(
            PemSchema::class,
            $conditions,
            self::getNotFoundMsg(),
        );
    }

    public static function createPem($attrs) {
        try {
            return [true, PemSchema::create($attrs)];
        } catch (QueryException $e) {
            return ["error", ErrorUtil::parse($e->getMessage())];
        }
    }
}
