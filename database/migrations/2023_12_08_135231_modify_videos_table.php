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
    Schema::table('videos', function (Blueprint $table) {
      $table->foreign('created_by')->references('id')->on('users')
        ->onDelete('CASCADE')->onUpdate('CASCADE');
      $table->foreign('updated_by')->references('id')->on('users')
        ->onDelete('CASCADE')->onUpdate('CASCADE');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('videos', function (Blueprint $table) {
      $table->foreign('created_by')->references('id')->on('users')
        ->onDelete('CASCADE')->onUpdate('CASCADE');
      $table->foreign('updated_by')->references('id')->on('users')
        ->onDelete('CASCADE')->onUpdate('CASCADE');
    });
  }
};
