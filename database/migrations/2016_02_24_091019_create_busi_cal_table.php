<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusiCalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     * @table_name: busi_cals
     */
    public function up()
    {
        Schema::create('busi_cals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('office_id');                         // index of office
            $table->integer('office_man_id');                     // index of officer
            $table->dateTime('main_date')->default('0000-00-00'); // main date of business calendar
            $table->string('address');                            // address of field
            $table->string('field_name');                         // name of field
            $table->integer('trans_item_id');                     // index of transaction
            $table->string('time');                               // time of period
            $table->integer('order_check')->default('0');         // status of order/estimate. 0: estimate(color-green), 1: order(color-pink)
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
        Schema::drop('busi_cals');
    }
}
