<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('category', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->integer('image_id')->unsigned();
        $table->integer('parent')->unsigned()->nullable();
        $table->foreign('image_id')->references('id')->on('image');
        $table->foreign('parent')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('category');
  }
}
