<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("groups", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("workspace_id");
            $table
                ->foreign("workspace_id")
                ->references("id")
                ->on("workspaces");
            $table->integer("profile_type");
            $table->string("title", 128);

            $table->unique(["workspace_id", "title"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("groups");
    }
};
