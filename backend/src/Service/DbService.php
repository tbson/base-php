<?php
namespace Src\Service;

use Illuminate\Database\QueryException;
use Src\Interface\Db;
use Src\Util\ErrorUtil;

/**
 * @module Src\Service\DbService;
 */
class DbService implements Db {
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

    public static function getListQuery($schema, $conditions = []) {
        return $schema::where($conditions);
    }

    public static function applySearch($query, $searchField, $searchValue) {
        if (empty($searchField) || empty($searchValue)) {
            return $query;
        }
        $query = $query->where(function ($query) use ($searchField, $searchValue) {
            foreach ($searchField as $field) {
                $query = $query->orWhere($field, "like", "%{$searchValue}%");
            }
            return $query;
        });
        return $query;
    }

    public static function applyOrder($query, $orderData) {
        return $query->orderBy(...$orderData);
    }

    public static function applyFilter($query, $filterData) {
        if (empty($filterData)) {
            return $query;
        }
        return $query->where($filterData);
    }

    public static function applyPaginate($query, $pageSise) {
        return $query->paginate($pageSise);
    }

    public static function getListItem($query, $conditions, $orderBy = ["id", "desc"]) {
        $query = $query->where($conditions);
        return $query->orderBy(...$orderBy)->get();
    }

    public static function getItem($schema, $conditions, $msg = "Item not found") {
        $query = $schema::where($conditions);
        $result = $query->first();

        if ($result === null) {
            return ["error", ErrorUtil::parse($msg)];
        }
        return ["ok", $result];
    }

    public static function createItem($schema, $attrs) {
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

    public static function deleteItem($schema, $conditions, $id) {
        $query = $schema::where("id", $id);
        if (!is_null($conditions) && !empty($conditions)) {
            $query = $query->where($conditions);
        }
        $query->delete();
        return ["ok", null];
    }

    public static function deleteItems($schema, $conditions, $ids) {
        $query = $schema::whereIn("id", $ids);
        if (!is_null($conditions) && !empty($conditions)) {
            $query = $query->where($conditions);
        }
        $query->delete();
        return ["ok", null];
    }
}
