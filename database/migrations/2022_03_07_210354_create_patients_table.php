<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->string('clinic_code');
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->integer('age');
            $table->string('phoneNumber')->nullable();
            $table->longText('address');
            $table->tinyInteger('gender');
            $table->longText('summary')->nullable();
            $table->longText('drug_allergy')->nullable();
            $table->integer('status')->default(1);
            $table->longText('Ref');
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
        Schema::dropIfExists('patients');
    }
}
