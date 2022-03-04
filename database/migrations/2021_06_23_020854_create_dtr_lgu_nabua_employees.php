<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtrLguNabuaEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtr_lgu_nabua_employees', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('title', 16)->nullable();
            $table->string('first_name', 128)->nullable();
            $table->string('middle_name', 128)->nullable();
            $table->string('last_name', 128)->nullable();
            $table->string('name_suffix', 16)->nullable();
            $table->boolean('is_male')->default(0);
            $table->date('date_of_birth')->nullable();
            $table->string('avatar', 128)->nullable();
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
        Schema::dropIfExists('dtr_lgu_nabua_employees');
    }
}
