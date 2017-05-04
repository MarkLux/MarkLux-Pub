<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTotalPriceToPbfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('power_builder_forms', function (Blueprint $table) {
            //
            $table->integer('total_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('power_builder_forms', function (Blueprint $table) {
            //
            $table->dropColumn('total_price');
        });
    }
}
