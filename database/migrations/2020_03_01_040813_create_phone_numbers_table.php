<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhoneNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_number', function (Blueprint $table) {
            $table->bigIncrements('id_phone_number');
            $table->bigInteger('id_country')->unsigned();
            $table->bigInteger('area_code');
            $table->bigInteger('number');
        });

        Schema::table('phone_number', function (Blueprint $table) {
            $table->foreign('id_country')->references('id_country')->on('country');
        });

        DB::unprepared('ALTER TABLE phone_number ADD UNIQUE key unique_phone_number (number)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phone_number');
    }
}
