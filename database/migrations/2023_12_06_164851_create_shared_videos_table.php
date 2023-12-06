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
        Schema::create('shared_videos', function (Blueprint $table) {
            $table->id();
            $table->uuid('video_id');
            $table->foreign('video_id')->references('id')->on('videos')
            ->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shared_videos');
    }
};
