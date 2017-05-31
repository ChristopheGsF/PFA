<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupInboxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('inboxe_groups', function (Blueprint $table) {
        $table->increments('hash');
        $table->integer('f_user')->unsigned();
        $table->foreign('f_user')->references('id')->on('users');
        $table->integer('s_user')->unsigned();
        $table->foreign('s_user')->references('id')->on('users');
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('inboxe_groups');
    }
}
