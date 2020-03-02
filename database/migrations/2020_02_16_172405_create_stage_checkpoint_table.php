<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStageCheckpointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stage_checkpoint', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_stage')->unsigned();
            $table->bigInteger('id_checkpoint')->unsigned();
        });

        Schema::table('stage_checkpoint', function (Blueprint $table) {
            $table->foreign('id_checkpoint')->references('id_checkpoint')->on('checkpoint');
            $table->foreign('id_stage')->references('id_stage')->on('stage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stage_checkpoint');
    }
}
