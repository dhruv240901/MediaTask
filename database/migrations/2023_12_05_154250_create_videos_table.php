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
        Schema::create('videos', function (Blueprint $table) {
          $table->uuid('id')->primary();
          $table->string('name', 51);
          $table->string('file_url')->nullable();
          $table->string('slug')->nullable();
          $table->boolean('is_active')->default(1)->comment('0:Blocked,1:Active');
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
        Schema::dropIfExists('videos');
    }
};
