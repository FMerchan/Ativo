<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckpointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkpoint', function (Blueprint $table) {
            $table->bigIncrements('id_checkpoint');
            $table->bigInteger('id_distance')->unsigned()->nullable();
            $table->bigInteger('id_duration')->unsigned()->nullable();
            $table->bigInteger('id_rythm_per_km')->unsigned();
        });

        Schema::table('checkpoint', function (Blueprint $table) {
            $table->foreign('id_distance')->references('id_distance')->on('distance');
            $table->foreign('id_rythm_per_km')->references('id_rythm_per_km')->on('rythm_per_km');
            $table->foreign('id_duration')->references('id_duration')->on('duration');
        });
        DB::unprepared('ALTER TABLE checkpoint ADD UNIQUE key unique_checkpoint (id_distance,id_rythm_per_km,id_duration)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkpoint');
    }
}
