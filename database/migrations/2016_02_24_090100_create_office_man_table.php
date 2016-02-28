<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficeManTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     * @table_name: office_mans
     */
    public function up()
    {
        Schema::create('office_mans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('office_id');           // index of office
            $table->integer('code');                // code
            $table->string('huri_office_man_name'); // hurigana name of officer
            $table->string('office_man_name');      // name of officer
            $table->integer('v_index');             // represent the display order
            $table->string('v_status');             // the status of visible, 1: visible 0: invisible
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
        Schema::drop('office_mans');
    }
}
