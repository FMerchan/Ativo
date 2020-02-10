<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training', function (Blueprint $table) {
            $table->bigIncrements('id_training');
            $table->string('name', 50);
            $table->string('photo', 250);
            $table->bigInteger('id_level')->unsigned();
            $table->bigInteger('id_distance')->unsigned();
            $table->bigInteger('id_duration')->unsigned();
            $table->unique('name');
        });
        Schema::table('training', function (Blueprint $table) {
            $table->foreign('id_level')->references('id_level')->on('level');
            $table->foreign('id_distance')->references('id_distance')->on('distance');
            $table->foreign('id_duration')->references('id_duration')->on('duration');
        });

        DB::unprepared('ALTER TABLE training ADD UNIQUE key unique_training (id_level,id_distance,id_duration)');
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training');
    }
}
