<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievement', function (Blueprint $table) {
            $table->bigIncrements('id_achievement');
            $table->string('name', 50);
            $table->date('date', 50);
            $table->string('photo', 250);
            $table->boolean('completed')->default(0);
            $table->unique('name');
        });

        DB::unprepared('ALTER TABLE achievement ADD UNIQUE key unique_achievement (name)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('achievement');
    }
}
