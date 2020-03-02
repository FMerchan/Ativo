<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingWithStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_with_stage', function (Blueprint $table) {
            $table->bigIncrements('id_training_with_stage');
            $table->bigInteger('id_profile')->unsigned();
            $table->bigInteger('id_training')->unsigned();
            $table->dateTime('date_start');
            $table->dateTime('date_end');
        });

        Schema::table('training_with_stage', function (Blueprint $table) {
            $table->foreign('id_training')->references('id_training')->on('training');
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
        Schema::dropIfExists('training_with_stage');
    }
}
