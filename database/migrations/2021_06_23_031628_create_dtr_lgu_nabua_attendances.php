<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtrLguNabuaAttendances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtr_lgu_nabua_attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('designation_id');
            $table->unsignedTinyInteger('log_mode_id');
            $table->dateTime('date_time')->nullable();
            $table->timestamps();

            $table->foreign('designation_id')->references('id')->on('dtr_lgu_nabua_designations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('log_mode_id')->references('id')->on('dtr_lgu_nabua_log_modes')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtr_lgu_nabua_attendances');
    }
}
