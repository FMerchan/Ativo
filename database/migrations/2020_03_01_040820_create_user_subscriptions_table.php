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
            $table->bigInteger('id_profile')->unsigned();
        });

        Schema::table('user_subscription', function (Blueprint $table) {
            $table->foreign('id_profile')->references('id_profile')->on('profile');
            $table->foreign('id_operator')->references('id_operator')->on('operator');
            $table->foreign('id_operator_plan')->references('id_operator_plan')->on('operator_plan');
        });

        
        DB::unprepared('ALTER TABLE user_subscription ADD UNIQUE key unique_user_subscription (id_profile)');
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
