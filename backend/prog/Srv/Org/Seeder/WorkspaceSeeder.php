<?php

namespace Prog\Srv\Org\Seeder;
use Prog\Srv\Org\Schema\WorkspaceSchema;

/**
 * @module Prog\Srv\Org\Seeder\WorkspaceSeeder;
 */
class WorkspaceSeeder
{
    private static function data($index)
    {
        return [
            "title" => "title {$index}",
            "is_super" => true,
        ];
    }

    private static function get_by($attr)
    {
        return WorkspaceSchema::where($attr)->first();
    }

    private static function create($attr)
    {
        return WorkspaceSchema::create($attr);
    }

    public static function one($index)
    {
        $data = self::data($index);
        $existItem = self::get_by($data);
        if ($existItem) {
            return $existItem;
        }
        return self::create($data);
    }

    public static function list($index)
    {
        array_map([WorkspaceSeeder::class, "one"], range(1, $index));
    }
}
