<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStepTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('step', function (Blueprint $table) {
        $table->increments('id');
        $table->string('ingredient');
        $table->integer('recipe_id')->unsigned();
        $table->integer('image_id')->unsigned();
        $table->foreign('recipe_id')->references('id')->on('recipe')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('image_id')->references('id')->on('image')->onDelete('cascade')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('step');
  }
}
