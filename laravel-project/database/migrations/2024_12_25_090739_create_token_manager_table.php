<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('token_manager', function (Blueprint $table) {
          $table->string('token',255)
          ->nullable(false)
          ->unique();
          $table->string('mail',20)
          ->nullable(false);
          $table->datetime('token_create_time')
          ->nullable(false);
          $table->datetime('token_limit_time')
          ->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('token_manager');
    }
};
