<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_registers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('username');//用户名
            $table->string('password');//密码
            $table->string('password_confirmation');//确认密码!

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_registers');
    }
}
