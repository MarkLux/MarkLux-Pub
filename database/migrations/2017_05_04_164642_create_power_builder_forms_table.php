<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePowerBuilderFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('power_builder_forms', function (Blueprint $table) {
            $table->string('mobile',45)->primaryKey(); // 手机号
            $table->string('name',45); // 姓名
            $table->string('qq',45); // QQ
            $table->string('nick_name',100);
            $table->string('sex',10); // 性别，填'男'或者'女'
            $table->integer('age'); // 年龄
            $table->string('province',100); // 省份
            $table->string('city',100); // 城市
            $table->string('company',100); // 公司名称
            $table->string('duty',100); // 职位
            $table->dateTime('arrival_time'); // 预计到达日期(精确到时间)
            $table->boolean('need_room'); // 是否需要订房
            $table->string('room_type',100)->nullable(); // 单人间/标准间
            $table->integer('days')->nullable(); // 订房天数
            $table->integer('self_lunch_count')->nullable(); // 午餐自助餐数量
            $table->boolean('need_receipt'); // 是否需要发票
            $table->string('receipt_header')->nullable(); // 发票抬头
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
        Schema::drop('power_builder_forms');
    }
}
