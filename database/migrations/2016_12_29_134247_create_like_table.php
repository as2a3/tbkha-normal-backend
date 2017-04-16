<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikeTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('like', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('recipe_id')->unsigned();
        $table->integer('user_id')->unsigned();
        $table->foreign('recipe_id')->references('id')->on('recipe')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('like');
  }
}
