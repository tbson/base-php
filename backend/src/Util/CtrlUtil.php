<?php
namespace Src\Util;

use Src\Setting;

/*
 * @module Src\Util\CtrlUtil;
 */
class CtrlUtil {
    private static function parseOrder($orderStr) {
        # "-id" => ["id", "desc"]
        # "+id" => ["id", "asc"]
        # "id" => ["id", "asc"]

        if (empty($orderStr)) {
            return ["id", "desc"];
        }

        if (substr($orderStr, 0, 1) !== "+" && substr($orderStr, 0, 1) !== "-") {
            $orderStr = "+" . $orderStr;
        }

        $order = substr($orderStr, 0, 1) === "-" ? "desc" : "asc";
        $field = substr($orderStr, 1);

        return [$field, $order];
    }

    public static function parseQueryParams($queryParams, $searchFields = []) {
        $searchData = [
            "fields" => $searchFields,
            "value" => MapUtil::get($queryParams, "q", ""),
        ];
        $orderData = self::parseOrder(MapUtil::get($queryParams, "order", ""));
        $filterData = array_diff_key(
            $queryParams,
            array_flip(["user", "q", "order", "page"]),
        );
        return [$searchData, $orderData, $filterData, Setting::DEFAULT_PAGE_SIZE];
    }

    public static function formatPaginate($paginateData, $extra = []) {
        $total = $paginateData->total();
        $pageSize = $paginateData->perPage();
        $pages = ceil($total / $pageSize);
        return [
            "count" => $total,
            "extra" => $extra,
            "items" => $paginateData->items(),
            "links" => [
                "next" => $paginateData->nextPageUrl(),
                "prev" => $paginateData->previousPageUrl(),
            ],
            "page_size" => $pageSize,
            "pages" => $pages,
        ];
    }

    public static function formatNoPaginate($items, $extra = []) {
        $total = count($items);
        $pageSize = $total;
        $pages = 1;
        return [
            "count" => $total,
            "extra" => $extra,
            "items" => $items,
            "links" => [
                "next" => null,
                "prev" => null,
            ],
            "page_size" => $pageSize,
            "pages" => $pages,
        ];
    }
}
