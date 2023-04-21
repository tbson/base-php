<?php

namespace Src\Service\Role\Schema;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;

/**
 * @module Src\Service\Role\Schema\PemSchema;
 */
class PemSchema extends Model
{
    protected $table = "pems";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["profile_types", "title", "module", "action"];

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
    protected $casts = [
        "profile_types" => "array",
    ];

    public static $rules = [
        "profile_types" => "required|array",
        "title" => "required|string",
        "module" => "required|string",
        "action" => "required|string",
    ];

    public static $messages = [
        "profile_types.array" => "profile_types must be an array",
    ];

    public function group()
    {
        return $this->belongsToMany(
            Src\Service\Account\SchemaGroupSchema::class,
            "groups_pems",
            "pem_id",
            "group_id"
        );
    }
}
