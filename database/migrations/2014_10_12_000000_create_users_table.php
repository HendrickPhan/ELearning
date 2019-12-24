<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('role');
            $table->tinyInteger('gender')->nullable();
            $table->string('name', 60);
            $table->string('avatar', 100)->nullable();
            $table->timestamp('date_of_birth')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('lp')->default(0);
            $table->unsignedInteger('cp')->default(0);
            $table->tinyInteger('status');
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
