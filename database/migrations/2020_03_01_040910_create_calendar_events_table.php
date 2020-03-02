<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_event', function (Blueprint $table) {
            $table->bigIncrements('id_calendar_event');
            $table->string('name', 50);
            $table->string('description', 150);
            $table->boolean('important');
            $table->string('image', 70);
            $table->string('city', 50);
            $table->string('type', 50);
            $table->string('link', 150);
            $table->dateTime('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar_event');
    }
}
