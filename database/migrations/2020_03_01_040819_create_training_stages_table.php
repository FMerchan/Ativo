<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_state', function (Blueprint $table) {
            $table->bigIncrements('id_training_state');
            $table->bigInteger('id_stage')->unsigned();
            $table->bigInteger('id_checkpoint')->unsigned();
            $table->bigInteger('id_training_with_stage')->unsigned();
            $table->boolean('is_current');
        });

        Schema::table('training_state', function (Blueprint $table) {
            $table->foreign('id_stage')->references('id_stage')->on('stage');
            $table->foreign('id_checkpoint')->references('id_checkpoint')->on('checkpoint');
            $table->foreign('id_training_with_stage')->references('id_training_with_stage')->on('training_with_stage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_state');
    }
}
