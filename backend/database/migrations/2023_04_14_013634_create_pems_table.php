<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("pems", function (Blueprint $table) {
            $table->id();
            $table->json("profile_types")->default(new Expression("(JSON_ARRAY())"));
            $table->string("title", 128);
            $table->string("module", 128);
            $table->string("action", 128);

            $table->unique(["module", "action"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("pems");
    }
};
