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
    Schema::create('problems', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->text('task');
      $table->text('image')->nullable();
      $table->text('solution')->nullable();
      $table->bigInteger('latex_file_id')->unsigned()->nullable();
      $table->foreign('latex_file_id')->references('id')->on('latex_files')->onDelete('cascade');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('problems');
  }
};
