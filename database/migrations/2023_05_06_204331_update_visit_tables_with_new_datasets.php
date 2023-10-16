<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVisitTablesWithNewDatasets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visits', function (Blueprint $table) {
            $table->string('sys_bp')->nullable();
            $table->string('dia_bp')->nullable();
            $table->string('pr')->nullable();
            $table->string('temp')->nullable();
            $table->string('spo2')->nullable();
            $table->string('rbs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
