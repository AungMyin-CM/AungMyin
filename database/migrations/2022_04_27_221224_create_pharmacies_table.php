<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmaciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacy', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->bigInteger('clinic_id')->unsigned();
            $table->foreign('clinic_id')->references('id')->on('clinic')->onDelete('cascade');
            $table->string('name');
            $table->date('expire_date')->nullable();
            $table->integer('quantity')->default(0);
            $table->float('act_price');
            $table->float('margin')->default(0);
            $table->float('sell_price');
            $table->string('unit');
            $table->longText('description')->nullable();
            $table->string('vendor')->nullable();
            $table->string('vendor_phoneNumber')->nullable();
            $table->integer('status')->default(1);
            $table->integer('storage_place')->nullable();
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
        Schema::dropIfExists('pharmacies');
    }
}
