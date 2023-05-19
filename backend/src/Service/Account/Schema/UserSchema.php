<?php

namespace Src\Service\Account\Schema;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
# use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
# use Illuminate\Notifications\Notifiable;
# use Laravel\Sanctum\HasApiTokens;
use Src\Util\CryptoUtil;

/**
 * @module Src\Service\Account\Schema\UserSchema;
 */
class UserSchema extends Authenticatable {
    protected $table = "users";

    # use HasApiTokens, HasFactory, Notifiable;

    protected $attributes = [
        "token_signature" => "",
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "email",
        "mobile",
        "password",
        "profile_type",
        "group_ids",
        "enabled",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "email_verified_at" => "datetime",
        "group_ids" => "array",
    ];

    public static $rules = [
        "name" => "required|string",
        "email" => "required|string|email",
        "mobile" => "string",
        "profile_type" => "required|integer",
        "password" => "required|string",
        "group_ids" => "required|array",
        "enabled" => "boolean",
    ];

    public static $updateRules = [
        "name" => "string",
        "email" => "string|email",
        "mobile" => "string",
        "profile_type" => "integer",
        "password" => "string",
        "group_ids" => "array",
        "enabled" => "boolean",
    ];

    public static $messages = [];

    public function setPasswordAttribute($value) {
        $this->attributes["password"] = CryptoUtil::hashPwd($value);
    }
}
