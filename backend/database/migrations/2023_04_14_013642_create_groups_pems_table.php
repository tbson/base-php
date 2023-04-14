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
        Schema::create("groups_pems", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("group_id");
            $table
                ->foreign("group_id")
                ->references("id")
                ->on("groups");

            $table->unsignedBigInteger("pem_id");
            $table
                ->foreign("pem_id")
                ->references("id")
                ->on("pems");

            $table->unique(["group_id", "pem_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("groups_pems");
    }
};
