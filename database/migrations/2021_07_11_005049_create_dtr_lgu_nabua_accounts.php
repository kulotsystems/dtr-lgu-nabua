<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtrLguNabuaAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtr_lgu_nabua_accounts', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedMediumInteger('employee_id')->unique();
            $table->string('code', 16)->unique();
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
        Schema::dropIfExists('dtr_lgu_nabua_accounts');
    }
}
