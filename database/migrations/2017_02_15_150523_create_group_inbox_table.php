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
        $table->integer('hash');
        $table->string('f_user');
        $table->foreign('f_user')->references('name')->on('users');
        $table->string('s_user');
        $table->foreign('s_user')->references('name')->on('users');
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
