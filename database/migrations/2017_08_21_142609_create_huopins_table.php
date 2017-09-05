<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHuopinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('huopins', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('goods_id');
            $table->string('attrs');//属性！
            $table->smallInteger('kucun');//库存！
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('huopins');
    }
}
