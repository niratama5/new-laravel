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
        Schema::create('bulletin_thread_reply', function (Blueprint $table) {
            $table->id('reply_id')
            ->nullable(false);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('thread_id');
            $table->string('reply_title',20)
            ->nullable(false);
            $table->string('reply_content',255)
            ->nullable(false);
            $table->datetime('reply_time')
            ->nullable(false);
            $table->datetime('reply_edit_time')
            ->nullable(false);
            $table->datetime('reply_delete_time')
            ->nullable(false);

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('thread_id')
            ->references('thread_id')
            ->on('bulletin_thread')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulletin_thread_reply');
    }
};
