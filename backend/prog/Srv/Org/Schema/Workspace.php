<?php

namespace Prog\Srv\Config\Schema;

use Illuminate\Database\Eloquent\Model;

class WorkspaceSchema extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["title", "is_super", "description", "type"];

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

    protected $table = "workspaces";
}
