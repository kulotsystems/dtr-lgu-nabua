<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtrLguNabuaLoginLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtr_lgu_nabua_login_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedMediumInteger('employee_id');
            $table->string('ip', 128)->nullable();
            $table->string('location', 255)->nullable();
            $table->string('network', 255)->nullable();
            $table->string('browser', 64)->nullable();
            $table->string('os', 64)->nullable();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('dtr_lgu_nabua_employees')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtr_lgu_nabua_login_logs');
    }
}
