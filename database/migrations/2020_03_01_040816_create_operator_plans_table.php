<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator_plan', function (Blueprint $table) {
            $table->bigIncrements('id_operator_plan');
            $table->string('name', 50);
            $table->double('cost', 8, 2);
            $table->bigInteger('id_operator')->unsigned();
        });

        Schema::table('operator_plan', function (Blueprint $table) {
            $table->foreign('id_operator')->references('id_operator')->on('operator');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operator_plan');
    }
}
