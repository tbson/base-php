<?php

namespace Src\UseCase\Account\User\Crud;

use Src\Setting;
use Src\Util\MapUtil;

/*
 * @module Src\UseCase\Account\User\Crud\CrudUserPresenter;
 */
class CrudUserPresenter {
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
            "name" => $item->name,
            "email" => $item->email,
            "mobile" => $item->mobile,
            "enabled" => $item->enabled ? true : false,
            "profile_type" => $item->profile_type,
            "profile_type_label" => MapUtil::get(
                Setting::PROFILE_TYPE_LABEL,
                $item->profile_type,
                "",
            ),
        ];
    }

    public static function presentDelete() {
        return ["ok" => true];
    }
}
