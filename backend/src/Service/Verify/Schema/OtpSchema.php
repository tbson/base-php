<?php

namespace Src\Service\Verify\Schema;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @module Src\Service\Verify\Schema\OtpSchema;
 */
class OtpSchema extends Model {
    use HasUuids;
    protected $table = "otps";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["target", "code", "ips", "expired_at", "extra_data"];

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
        "ips" => "array",
        "extra_data" => "array",
    ];

    public static $rules = [
        "target" => "required|string",
        "code" => "required|string",
        "ips" => "required|array",
        "expired_at" => "required|date",
    ];

    public static $messages = [];
}
