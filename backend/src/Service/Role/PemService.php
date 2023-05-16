<?php
namespace Src\Service\Role;

use Illuminate\Database\QueryException;
use Src\Interface\Role\Pem;
use Src\Service\Role\Schema\PemSchema;
use Src\Service\DbService;
use Src\Util\ErrorUtil;

/**
 * @module Src\Service\Role\PemService;
 */
class PemService implements Pem {
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

    public static function getPemOptionList() {
        $pemList = PemSchema::all()->sortBy("module");
        $pemOptionList = [];
        foreach ($pemList as $pem) {
            $pemOptionList[] = [
                "value" => $pem->id,
                "label" => $pem->title,
            ];
        }
        return $pemOptionList;
    }
}
