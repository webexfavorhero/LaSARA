<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     * @table_name: trans_items
     */
    public function up()
    {
        Schema::create('trans_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('v_index');       // management number, represent the display order
            $table->string('huri_item_name'); // hurigana name of item
            $table->string('item_name');      // name of item
            $table->string('mark_color');     // mark color of item font (1: black, 2: red, 3: blue)
            $table->string('other_cond');     // other condition (possible/impossible editing, 1: possible 0: impossible)
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
        Schema::drop('trans_items');
    }
}
