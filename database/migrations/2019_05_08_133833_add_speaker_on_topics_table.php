<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSpeakerOnTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->string('speaker_name');
            $table->string('speaker_email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumns('topics', ['speaker_name', 'speaker_email'])) {
            Schema::table('topics', function (Blueprint $table) {
                $table->dropColumn('speaker_name');
                $table->dropColumn('speaker_email');
            });
        }
    }
}
