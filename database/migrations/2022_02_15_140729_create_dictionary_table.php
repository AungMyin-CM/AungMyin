<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDictionaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dictionary', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->longText('meaning');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->tinyInteger('isCommon')->default('0');
            $table->tinyInteger('isMed')->default('0')->nullable();
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
        Schema::dropIfExists('dictionary');
    }
}
