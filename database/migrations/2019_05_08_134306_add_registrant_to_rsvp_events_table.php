<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('name_of_registrant');
            $table->string('registrant_email');
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
        if (Schema::hasColumns('rsvp_events', ['name_of_registrant', 'registrant_email', 'attended_at'])) {
            Schema::table('rsvp_events', function (Blueprint $table) {
                $table->dropColumn('name_of_registrant');
                $table->dropColumn('registrant_email');
                $table->dropColumn('attended_at');
            });
        }
    }
}
