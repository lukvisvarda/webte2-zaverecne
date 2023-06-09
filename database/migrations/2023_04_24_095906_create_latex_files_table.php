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
        Schema::create('latex_files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->binary('file');
            $table->json('parsed')->nullable();
            $table->boolean('assigned')->default(false);
            $table->integer('points')->default(0);
            $table->timestamp('available_from')->nullable();
            $table->timestamp('available_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latex_files');
    }
};
