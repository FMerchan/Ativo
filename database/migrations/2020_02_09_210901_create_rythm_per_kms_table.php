<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRythmPerKmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rythm_per_km', function (Blueprint $table) {
            $table->bigIncrements('id_rythm_per_km');
            $table->string('name', 50);
            $table->double('fmc_percentaje_base', 8, 2);
            $table->double('fmc_percentaje_limit', 8, 2);
            $table->unique('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rythm_per_km');
    }
}
