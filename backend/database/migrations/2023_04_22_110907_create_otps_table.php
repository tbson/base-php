<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("otps", function (Blueprint $table) {
            $table->id();
            $table->string("target");
            $table->string("code");
            $table->string("requested_ips");
            $table->dateTime("expired_time");
            $table->json("extra_data")->default(new Expression("(JSON_ARRAY())"));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("otps");
    }
};
