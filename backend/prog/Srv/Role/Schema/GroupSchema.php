<?php

namespace Prog\Srv\Role\Schema;

use Illuminate\Database\Eloquent\Model;

class GroupSchema extends Model
{
    protected $table = "groups";
    public $timestamps = false;

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

    public static $rules = [
        "workspace_id" => "required|integer",
        "profile_type" => "required|integer",
        "title" => "required|string",
    ];

    public static $messages = [];

    public function pem()
    {
        return $this->belongsToMany(
            Prog\Srv\Account\Schema\PemSchema::class,
            "groups_pems",
            "group_id",
            "pem_id"
        );
    }
}
