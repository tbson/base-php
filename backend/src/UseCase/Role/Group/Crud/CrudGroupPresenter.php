<?php

namespace Src\UseCase\Role\Group\Crud;

use Src\Setting;
use Src\Util\MapUtil;

/*
 * @module Src\UseCase\Role\Group\Crud\CrudGroupPresenter;
 */
class CrudGroupPresenter {
    public static function presentList($items) {
        $result = [];
        foreach ($items as $item) {
            $result[] = self::presentItem($item);
        }
        return $result;
    }

    public static function presentItem($item) {
        return [
            "id" => $item->id,
            "title" => $item->title,
            "profile_type" => $item->profile_type,
            "profile_type_label" => MapUtil::get(
                Setting::PROFILE_TYPE_LABEL,
                $item->profile_type,
                "",
            ),
            "default" => $item->default ? true : false,
        ];
    }

    public static function presentDelete() {
        return ["ok" => true];
    }
}
