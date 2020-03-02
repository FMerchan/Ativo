<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->bigIncrements('id_profile');
            $table->bigInteger('id_user_subscription')->unsigned();
        });

        Schema::table('profile', function (Blueprint $table) {
            $table->foreign('id_user_subscription')->references('id_user_subscription')->on('user_subscription');
        });

        DB::unprepared('ALTER TABLE profile ADD UNIQUE key unique_user_subscription (id_user_subscription)');
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile');
    }
}
