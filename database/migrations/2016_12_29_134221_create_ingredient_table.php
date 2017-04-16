<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('ingredient', function (Blueprint $table) {
        $table->increments('id');
        $table->string('ingredient');
        $table->integer('recipe_id')->unsigned();
        $table->foreign('recipe_id')->references('id')->on('recipe')->onDelete('cascade')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('ingredient');
  }
}
