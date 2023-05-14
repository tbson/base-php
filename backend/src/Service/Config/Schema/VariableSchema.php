<?php

namespace Src\Service\Config\Schema;

use Illuminate\Database\Eloquent\Model;

/**
 * @module Src\Service\Config\Schema\VariableSchema;
 */
class VariableSchema extends Model {
    protected $table = "variables";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["uid", "value", "description", "type"];

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
        "uid" => "required|string|unique:variables",
        "value" => "required|string",
        "description" => "required|string",
        "type" => "required|integer",
    ];

    public static $updateRules = [
        "uid" => "string",
        "value" => "string",
        "description" => "string",
        "type" => "integer",
    ];

    public static $messages = [];
}
