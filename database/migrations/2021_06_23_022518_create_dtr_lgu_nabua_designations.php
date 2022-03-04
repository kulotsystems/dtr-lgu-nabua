<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtrLguNabuaDesignations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtr_lgu_nabua_designations', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedTinyInteger('office_id');
            $table->unsignedSmallInteger('position_id');
            $table->unsignedMediumInteger('employee_id');
            $table->date('date')->nullable();
            $table->boolean('is_head')->default(0);
            $table->enum('type', ['Regular', 'Contractual', 'Job Order', 'Casual', 'Probationary']);
            $table->timestamps();

            $table->foreign('office_id')->references('id')->on('dtr_lgu_nabua_offices')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('position_id')->references('id')->on('dtr_lgu_nabua_positions')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('employee_id')->references('id')->on('dtr_lgu_nabua_employees')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtr_lgu_nabua_designations');
    }
}
