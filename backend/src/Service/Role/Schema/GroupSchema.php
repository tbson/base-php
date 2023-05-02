<?php

namespace Src\Service\Role\Schema;

use Illuminate\Database\Eloquent\Model;

/**
 * @module Src\Service\Role\Schema\GroupSchema;
 */
class GroupSchema extends Model {
    protected $table = "groups";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["profile_type", "title", "default"];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    public static $rules = [
        "profile_type" => "required|integer",
        "title" => "required|string",
        "default" => "boolean",
    ];

    public static $messages = [];

    public function pem() {
        return $this->belongsToMany(
            \Src\Service\Role\Schema\PemSchema::class,
            "groups_pems",
            "group_id",
            "pem_id",
        );
    }
}
