<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->integer('role_id')->nullabel();
            $table->string('speciality')->nullable();
            $table->text('credentials')->nullable();
            $table->string('name');
            $table->longText('avatar')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('phoneNumber');
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->longText('address')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->text('short_bio')->nullable();
            $table->float('fees')->nullable();
            $table->integer('email_verified')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('super_admin')->default(0);
            $table->string('lastest_ip')->nullable();
            $table->tinyInteger('user_type')->default('1');
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
