<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingStageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_stage', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_training')->unsigned();
            $table->integer('id_stage')->unsigned();
        });

        // Schema::table('training_stage', function (Blueprint $table) {
        //     $table->foreign('id_training')->references('id_training')->on('training');
        //     $table->foreign('id_stage')->references('id_stage')->on('stage');
        // }); TODO RESOLVER

        DB::unprepared('ALTER TABLE checkpoint ADD UNIQUE key unique_training_stage (id_training,id_stage)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_stage');
    }
}
