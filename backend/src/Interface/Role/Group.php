<?php

namespace Src\Interface\Role;

/**
 * Interface Group
 * @package Src\Interface\Role\Group;
 */
interface Group {
    public static function getSchema();
    public static function getGroup($conditions);
    public static function createGroup($attrs);
    public static function updateGroup($conditions, $attrs);
    public static function deleteGroup($conditions, $id);
    public static function deleteGroups($conditions, $ids);
}
