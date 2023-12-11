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
    Schema::create('comments', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('name', 51);
      $table->uuid('video_id');
      $table->uuid('user_id');
      $table->foreign('user_id')->references('id')->on('users')
      ->onDelete('CASCADE')->onUpdate('CASCADE');
      $table->uuid('created_by')->nullable();
      $table->foreign('created_by')->references('id')->on('users')
      ->onDelete('CASCADE')->onUpdate('CASCADE');
      $table->uuid('updated_by')->nullable();
      $table->foreign('updated_by')->references('id')->on('users')
      ->onDelete('CASCADE')->onUpdate('CASCADE');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('comments');
  }
};
