<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_purchase', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('clinic_id');
            $table->integer('price');
            $table->integer('payment_method')->default('1');
            $table->tinyInteger('status');
            $table->date('expire_at');
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
        Schema::dropIfExists('package_purchases');
    }
}
