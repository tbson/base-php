<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create("users", function (Blueprint $table) {
            $table->id();

            $table->integer("profile_type");
            $table->string("name");
            $table->string("email");
            $table->string("mobile");
            $table->string("password");
            $table->boolean("enabled")->default(false);
            $table->json("group_ids")->default(new Expression("(JSON_ARRAY())"));

            $table->text("token_signature");
            $table->dateTime("token_refresh_expired")->nullable();

            $table->dateTime("email_verified_at")->nullable();
            $table->dateTime("mobile_verified_at")->nullable();

            $table->rememberToken();

            $table->dateTime("last_login")->nullable();
            $table->dateTime("last_change_pwd")->nullable();

            $table->timestamps();

            $table->unique(["email"]);
            $table->unique(["mobile"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists("users");
    }
};
