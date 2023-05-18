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
      Schema::table('latex_files', function (Blueprint $table) {
        $table->timestamp('available_from')->nullable();
        $table->timestamp('available_to')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::table('latex_files', function (Blueprint $table) {
        $table->timestamp('available_from');
        $table->timestamp('available_to');
      });
    }
};
