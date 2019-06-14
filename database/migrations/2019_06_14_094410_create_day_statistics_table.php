<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDayStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('total_hours');
            $table->decimal('total_free_hours');
            $table->decimal('total_extra_hours');
            $table->integer('day_id')->unsigned();
            $table->foreign('day_id')
                    ->references('id')->on('days')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('day_statistics');
    }
}
