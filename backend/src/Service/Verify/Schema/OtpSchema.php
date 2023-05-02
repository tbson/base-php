<?php

namespace Src\Service\Verify\Schema;

use Illuminate\Database\Eloquent\Model;

/**
 * @module Src\Service\Verify\Schema\OtpSchema;
 */
class OtpSchema extends Model {
    protected $table = "otps";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "target",
        "code",
        "requested_ips",
        "expired_time",
        "extra_data",
    ];

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
        "target" => "required|string",
        "code" => "required|string",
        "requested_ips" => "required|string",
        "expired_time" => "required|date",
    ];

    public static $messages = [];
}
