<?php

namespace Src\Service\Account\Schema;

use Illuminate\Database\Eloquent\Model;

class UserSchema extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["workspace_id", "profile_type", "title"];

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

    protected $table = "groups";

    public function pem()
    {
        return $this->belongsToMany(
            Src\Service\Account\Schema\PemSchema::class,
            "groups_pems",
            "group_id",
            "pem_id"
        );
    }
}
