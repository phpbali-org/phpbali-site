<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->text('slug');
            $table->string('name');
            $table->text('desc');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->text('place');
            $table->text('place_name');
            $table->text('latitude');
            $table->text('longitude');
            $table->tinyInteger('published')->default(0);
            $table->tinyInteger('deleted')->default(0);
            $table->string('photos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
