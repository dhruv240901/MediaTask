<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
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
      $table->enum('gender', ['Male', 'Female'])->nullable();
      $table
        ->boolean('is_active')
        ->default(1)
        ->comment('0:Blocked,1:Active');
      $table->string('profile_image')->nullable();
      $table->string('profile_image_url')->nullable();
      $table->uuid('created_by')->nullable();
      $table->uuid('updated_by')->nullable();
      $table->uuid('deleted_by')->nullable();
      $table->timestamps();
      $table->softDeletes();
      $table
        ->boolean('is_deleted')
        ->default(0)
        ->comment('0:No,1:Yes');
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
