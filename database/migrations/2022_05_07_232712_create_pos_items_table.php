<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_item', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pos_id')->unsigned();
            $table->foreign('pos_id')->references('id')->on('pos')->onDelete('cascade');
            $table->bigInteger('med_id')->unsigned();
            $table->foreign('med_id')->references('id')->on('pharmacy')->onDelete('cascade');
            $table->string('med_name');
            $table->string('expire_date');
            $table->integer('quantity')->default(0);
            $table->float('act_price');
            $table->float('margin')->default(0);
            $table->float('sell_price');
            $table->string('unit');
            $table->float('total_price');
            $table->float('discount')->nullable();
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
        Schema::dropIfExists('pos_items');
    }
}
