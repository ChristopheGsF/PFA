<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('articles', function (Blueprint $table) {
          $table->increments('id');
          $table->string('title');
          $table->string('brand');
          $table->string('model');
          $table->string('price');
          $table->string('color');
          $table->string('release');
          $table->string('img');
          $table->string('brand_img');
          $table->text('content');
          $table->timestamps();
          $table->integer('user_id')->unsigned();
          $table->foreign('user_id')->references('id')->on('users');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
