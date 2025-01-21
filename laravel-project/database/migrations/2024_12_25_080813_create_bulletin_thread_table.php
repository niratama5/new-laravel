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
        Schema::create('bulletin_thread', function (Blueprint $table) {
            $table->id('id');

            $table->string('thread_title',20)
                  ->nullable(false);

            $table->string('post_content',255)
                  ->nullable(false);

            $table->timestamps();

            $table->boolean('deleted_at')
                  ->default(false);

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulletin_thread');
    }
};