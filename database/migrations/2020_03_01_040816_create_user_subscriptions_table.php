<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subscription', function (Blueprint $table) {
            $table->bigIncrements('id_user_subscription');
            $table->bigInteger('id_operator')->unsigned();
            $table->bigInteger('id_operator_plan')->unsigned();
            $table->bigInteger('is_valid')->unsigned();
        });

        Schema::table('user_subscription', function (Blueprint $table) {
            $table->foreign('id_operator')->references('id_operator')->on('operator');
            $table->foreign('id_operator_plan')->references('id_operator_plan')->on('operator_plan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_subscription');
    }
}
