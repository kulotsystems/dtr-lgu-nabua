<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtrLguNabuaFingerprints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtr_lgu_nabua_fingerprints', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedMediumInteger('employee_id');
            $table->unsignedTinyInteger('finger_id');
            $table->binary('fingerprint')->nullable();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('dtr_lgu_nabua_employees')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('finger_id')->references('id')->on('dtr_lgu_nabua_fingers')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtr_lgu_nabua_fingerprints');
    }
}
