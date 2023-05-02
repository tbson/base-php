<?php
namespace Src\Service;

use Illuminate\Database\QueryException;
use Src\Util\ErrorUtil;

/**
 * @module Src\Service\DbService;
 */
class DbService {
    public static function ensureMissingItem(
        $schema,
        $conditions,
        $msg = "Item already exist",
    ) {
        $result = $schema::where($conditions)->first();
        if ($result !== null) {
            return ["error", ErrorUtil::parse($msg)];
        }
        return ["ok", null];
    }

    public static function getListItem(
        $query,
        $conditions,
        $orderBy = ["id", "desc"],
    ) {
        $query = $query->where($conditions);
        return $query->orderBy(...$orderBy)->get();
    }

    public static function getItem(
        $schema,
        $conditions,
        $msg = "Item not found",
    ) {
        $query = $schema::where($conditions);
        $result = $query->first();

        if ($result === null) {
            return ["error", ErrorUtil::parse($msg)];
        }
        return ["ok", $result];
    }

    public static function insertItem($schema, $attrs) {
        try {
            return [true, $schema::create($attrs)];
        } catch (QueryException $e) {
            return ["error", ErrorUtil::parse($e->getMessage())];
        }
    }

    public static function updateItem($schema, $conditions, $attrs) {
        [$status, $item] = self::getItem($schema, $conditions);
        if ($status === "error") {
            return [$status, $item];
        }

        try {
            $item->update($attrs);
            $item->save();
            return ["ok", $item];
        } catch (QueryException $e) {
            return ["error", ErrorUtil::parse($e->getMessage())];
        }
    }
}
