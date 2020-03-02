<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileAchievementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_achievement', function (Blueprint $table) {
            $table->bigIncrements('id_profile_achievement');
            $table->bigInteger('id_profile')->unsigned();
            $table->bigInteger('id_achievement')->unsigned();
            $table->dateTime('date_achievement');
        });

        Schema::table('profile_achievement', function (Blueprint $table) {
            $table->foreign('id_profile')->references('id_profile')->on('profile');
            $table->foreign('id_achievement')->references('id_achievement')->on('achievement');
        });

        DB::unprepared('ALTER TABLE profile_achievement ADD UNIQUE key unique_profile_achievement (id_profile,id_achievement)');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_achievement');
    }
}
