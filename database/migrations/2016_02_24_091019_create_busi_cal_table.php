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
            $table->date('main_date')->default('0000-00-00');     // main date of business calendar
            $table->integer('office_id');                         // index of office
            $table->integer('office_man_id');                     // index of officer
            $table->integer('cell_id');                           // index of cell(default 1~8, in some case addable)
            $table->string('address');                            // address of field
            $table->string('field_name');                         // name of field
            $table->integer('trans_item_id');                     // index of transaction
            $table->string('time');                               // time of period
            $table->integer('order_check')->default('0');         // status of order/estimate. 0: empty(color-white), 1: estimate(color-green: #ccffcc), 2: order(color-pink: #ff99cc)
            $table->integer('edit_status')->default('0');         // status of editing or not editing. 0: not editing, 1: editing
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
