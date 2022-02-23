<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->string('price')->default('0');
            $table->integer('trialPeriod')->nullable();
            $table->tinyInteger('isDiscount')->default(0);
            $table->integer('discountPercentage')->nullable();
            $table->datetime('discountStartDate')->nullable();
            $table->datetime('discountEndDate')->nullable();
            $table->tinyInteger('status')->default('1');
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
        Schema::dropIfExists('package');
    }
}
