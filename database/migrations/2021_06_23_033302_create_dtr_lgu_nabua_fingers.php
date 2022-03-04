<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDtrLguNabuaFingers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtr_lgu_nabua_fingers', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('title', 16)->nullable();
            $table->timestamps();
        });

        DB::table('dtr_lgu_nabua_fingers')->insert([
            [
                'title' => 'LEFT THUMB'
            ],
            [
                'title' => 'RIGHT THUMB'
            ],
            [
                'title' => 'LEFT INDEX'
            ],
            [
                'title' => 'RIGHT INDEX'
            ],
            [
                'title' => 'LEFT MIDDLE'
            ],
            [
                'title' => 'RIGHT MIDDLE'
            ],
            [
                'title' => 'LEFT RING'
            ],
            [
                'title' => 'RIGHT RING'
            ],
            [
                'title' => 'LEFT LITTLE'
            ],
            [
                'title' => 'RIGHT LITTLE'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtr_lgu_nabua_fingers');
    }
}
