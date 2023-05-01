<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
  {
    Schema::create('assigned_thesis', function (Blueprint $table) {
      $table->id();
      $table->json('selectedFiles');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('assigned_thesis');
  }
};
