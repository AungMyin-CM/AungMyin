<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patient')->onDelete('cascade');
            $table->integer('pos_id')->nullable();
            $table->longText('prescription')->nullable();
            $table->longText('diag')->nullable();
            $table->longText('assigned_medicines')->nullable();
            $table->longText('images')->nullable();
            $table->float('fees')->nullable()->default(0.00);
            $table->integer('is_foc')->default(false)->nullable();
            $table->integer('user_id');
            $table->longText('investigation')->nullable();
            $table->longText('procedure')->nullable();
            $table->integer('is_followup')->default(0)->nullable();
            $table->timestamp('followup_date')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('visits');
    }
}
