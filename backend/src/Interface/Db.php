<?php

namespace Src\Interface;
/**
 * Interface Db
 * @package Src\Interface\Db
 */
interface Db {
    public static function ensureMissingItem($schema, $conditions, $msg);
    public static function getListQuery($schema, $conditions);
    public static function applySearch($query, $fields, $value);
    public static function applyOrder($query, $orderBy);
    public static function applyFilter($query, $filter);
    public static function applyPaginate($query, $pageSise);
    public static function getListItem($query, $conditions, $orderBy);
    public static function getItem($schema, $conditions, $msg);
    public static function createItem($schema, $attrs);
    public static function updateItem($schema, $conditions, $attrs);
    public static function deleteItem($schema, $conditions, $id);
    public static function deleteItems($schema, $conditions, $ids);
}
