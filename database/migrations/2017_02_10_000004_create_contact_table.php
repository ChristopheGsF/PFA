<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('contacts', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('last_name')->nullable();
        $table->string('number')->nullable();
        $table->string('title');
        $table->string('email');
        $table->text('content');
        $table->timestamps();
        $table->integer('user_id')->unsigned()->nullable();
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
      Schema::dropIfExists('contacts');
    }
}
