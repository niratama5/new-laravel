<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',32)
                  ->nullable(false);
            $table->string('password',255)
                  ->nullable(false);
            $table->string('email',20)
                  ->nullable(false)
                  ->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->datetime('created_at')
            ->default(Carbon::now());
            $table->datetime('updated_at')
            ->default(Carbon::now());
            $table->datetime('deleted_at')
            ->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
