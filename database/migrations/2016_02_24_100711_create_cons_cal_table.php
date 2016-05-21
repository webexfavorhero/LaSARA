<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsCalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     * @table_name cons_cals
     */
    public function up()
    {
        Schema::create('cons_cals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('office_id');                         // index of office
            $table->integer('company_id');                        // index of company
            $table->integer('company_man_id');                    // index of company man
            $table->date('main_date')->default('0000-00-00');     // main date of construction calendar
            $table->integer('cell_id');                           // cell id (default 1~3)
            $table->string('field_name');                         // name of field
            $table->integer('char_color');                        // color of character, 1: black(#000000) 2: blue(#0000ff) 3: red(#ff0000)
            $table->string('content');                            // content of construction calendar
            $table->integer('back_color');                        // color of background, 1: #ffffff 2: #ccffcc 3: #ccffff 4: #99ccff
            $table->string('start_time');                         // start time of calendar
            $table->string('order_amount');                       // amount of order
            $table->integer('edit_status')->default('0');         // status of editing or not editing. 0: not editing, 1: editing
            $table->string('edit_user');                          // edit username
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
        Schema::drop('cons_cals');
    }
}
