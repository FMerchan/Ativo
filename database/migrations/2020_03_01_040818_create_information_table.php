<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information', function (Blueprint $table) {
            $table->bigIncrements('id_information');
            $table->string('name_last_name', 70);
            $table->string('city', 50);
            $table->string('email', 50);
            $table->boolean('notification_available');
            $table->string('gender', 50);
            $table->double('weight', 8, 2);
            $table->double('height', 8, 2);
            $table->string('photo', 70);
            $table->bigInteger('id_country')->unsigned();
            $table->bigInteger('id_phone_number')->unsigned();
            $table->bigInteger('id_profile')->unsigned();
        });

        Schema::table('information', function (Blueprint $table) {
            $table->foreign('id_country')->references('id_country')->on('country');
            $table->foreign('id_phone_number')->references('id_phone_number')->on('phone_number');
            $table->foreign('id_profile')->references('id_profile')->on('profile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('information');
    }
}
