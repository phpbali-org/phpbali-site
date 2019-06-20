<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetColumnsNullableOnRsvpEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rsvp_events', function (Blueprint $table) {
            $table->string('name_of_registrant')->nullable()->change();
            $table->string('registrant_email')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rsvp_events', function (Blueprint $table) {
            //
        });
    }
}
