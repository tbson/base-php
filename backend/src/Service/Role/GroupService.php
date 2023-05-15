<?php
namespace Src\Service\Role;
use Src\Interface\Role\Group;
use Src\Service\Role\Schema\GroupSchema;
use Src\Service\DbService;

/**
 * @module Src\Service\Role\GroupService;
 */
class GroupService implements Group {
    private static function getNotFoundMsg() {
        return __("Group not found");
    }

    public static function getSchema() {
        return GroupSchema::class;
    }

    public static function getGroup($conditions) {
        return DbService::getItem(
            GroupSchema::class,
            $conditions,
            self::getNotFoundMsg(),
        );
    }

    public static function createGroup($attrs) {
        return DbService::createItem(GroupSchema::class, $attrs);
    }

    public static function updateGroup($conditions, $attrs) {
        return DbService::updateItem(GroupSchema::class, $conditions, $attrs);
    }

    public static function deleteGroup($conditions, $id) {
        return DbService::deleteItem(GroupSchema::class, $conditions, $id);
    }

    public static function deleteGroups($conditions, $ids) {
        return DbService::deleteItems(GroupSchema::class, $conditions, $ids);
    }
}
