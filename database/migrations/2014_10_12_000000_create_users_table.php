<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('website')->nullable();
            $table->string('email')->unique();
            $table->integer('is_staff')->default(0);
            $table->string('password')->nullable();
            $table->string('photos')->default('default-avatar.png');
            $table->text('about')->nullable();
            $table->boolean('verified')->default(false);
            $table->string('auth_token')->nullable();
            $table->string('verify_token')->nullable();
            $table->string('github_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
