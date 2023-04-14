<?php

namespace Src\Service\Account\Schema;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;

class PemSchema extends Model
{
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
    protected $casts = [];

    protected $table = "pems";

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
