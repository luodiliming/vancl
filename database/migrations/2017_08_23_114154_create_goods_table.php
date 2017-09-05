<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title');//名称
            $table->integer('shichangprice');//市场价格
            $table->integer('shangchengprice');//商场价格
            $table->string('attrs');//属性
            $table->string('desc');///描述
            $table->string('content');//内容
            $table->integer('click');//点击
            $table->string('listimg');//商品列表图
            $table->integer('category_id');//'商品所属分类',

            $table->integer('inseckill');//'每日秒杀',
            $table->integer('intueijian');//'新品推荐',
            $table->integer('insellers');//'当季热卖',
            $table->integer('inactivity');//'活动专区',
            $table->integer('inmore');//'更多精品',

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
