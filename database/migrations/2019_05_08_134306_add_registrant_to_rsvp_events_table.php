<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegistrantToRsvpEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rsvp_events', function (Blueprint $table) {
            $table->string('name_of_registrant')->nullable();
            $table->string('registrant_email')->nullable();
            $table->timestamp('attended_at')->nullable();
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
            $table->dropColumn('name_of_registrant');
            $table->dropColumn('registrant_email');
            $table->dropColumn('attended_at');
        });
    }
}
