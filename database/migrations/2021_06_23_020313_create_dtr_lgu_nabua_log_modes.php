<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDtrLguNabuaLogModes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtr_lgu_nabua_log_modes', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('title', 128)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        DB::table('dtr_lgu_nabua_log_modes')->insert([
            [
                'title' => 'Morning In'
            ],
            [
                'title' => 'Morning Out'
            ],
            [
                'title' => 'Afternoon In'
            ],
            [
                'title' => 'Afternoon Out'
            ]
        ]);
    }

    /**s
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtr_lgu_nabua_log_modes');
    }
}
