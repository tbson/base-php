<?php

namespace Prog\Srv\Account\Schema;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
# use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
# use Illuminate\Notifications\Notifiable;
# use Laravel\Sanctum\HasApiTokens;
use Prog\Util\CryptoUtil;

class UserSchema extends Authenticatable
{
    protected $table = "users";

    # use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "workspace_id",
        "profile_type",
        "name",
        "email",
        "mobile",
        "password",
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
        "group_id" => "array",
    ];

    public static $rules = [
        "workspace_id" => "required|integer",
        "profile_type" => "required|integer",
        "name" => "required|string",
        "email" => "required|string|email",
        "mobile" => "string",
    ];

    public static $messages = [];

    public function setPasswordAttribute($value)
    {
        $this->attributes["password"] = CryptoUtil::hashPwd($value);
    }
}
