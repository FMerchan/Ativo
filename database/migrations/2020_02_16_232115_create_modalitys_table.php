<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatemodalitysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modality', function (Blueprint $table) {
            $table->bigIncrements('id_modality​');
            $table->string('title', 50);
            $table->string('description', 250);
            $table->string('photo', 250);
            $table->string('link', 250);            
            $table->unique('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modality');
    }
}
