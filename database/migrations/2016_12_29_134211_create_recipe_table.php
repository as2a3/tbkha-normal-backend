<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('recipe', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('description');
        $table->timestamps();
        $table->boolean('featured');
        $table->integer('preparing');
        $table->integer('serving');
        $table->integer('status');

        $table->integer('category_id')->unsigned();
        $table->integer('image_id')->unsigned();
        $table->integer('author_id')->unsigned();
        $table->foreign('category_id')->references('id')->on('category');
        $table->foreign('image_id')->references('id')->on('image');
        $table->foreign('author_id')->references('id')->on('users');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('recipe');
  }
}
