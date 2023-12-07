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
    Schema::create('users', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('name', 51);
      $table->string('email')->unique();
      $table->string('phone', 10)->nullable();
      $table->enum('gender', ['male', 'female'])->nullable();
      $table->boolean('is_active')->default(1)->comment('0:Blocked,1:Active');
      $table->string('profile_image')->nullable();
      $table->string('social_id');
      $table->string('social_type');
      $table->boolean('is_google_pic')->default(0)->comment('0:Blocked,1:Active');
      $table->uuid('created_by')->nullable();
      $table->uuid('updated_by')->nullable();
      $table->timestamps();
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
