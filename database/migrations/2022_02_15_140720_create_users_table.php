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
            $table->id();
            $table->string('code')->unique();
            $table->bigInteger('clinic_id')->unsigned();
            $table->foreign('clinic_id')->references('id')->on('clinic')->onDelete('cascade');
            $table->bigInteger('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('role');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('password');
            $table->bigInteger('phoneNumber')->default(12);
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->longText('address');
            $table->tinyInteger('gender');
            $table->tinyInteger('status');
            $table->string('lastest_ip')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at');
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
