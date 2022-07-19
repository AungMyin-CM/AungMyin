<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name');
            $table->string('phoneNumber');
            $table->text('address')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->integer('package_id');
            $table->timestamp('package_purchased_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('package_purchased_times')->default(0);
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
        Schema::dropIfExists('clinic');
    }
}