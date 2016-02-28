<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyManTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     * @table_name company_mans
     */
    public function up()
    {
        Schema::create('company_mans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('office_id');            // index of office
            $table->integer('company_id');           // index of company
            $table->string('huri_company_man_name'); // hurigana name of company man
            $table->string('company_man_name');      // name of company name
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
        Schema::drop('company_mans');
    }
}
