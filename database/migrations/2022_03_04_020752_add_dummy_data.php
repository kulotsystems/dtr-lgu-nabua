<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddDummyData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('dtr_lgu_nabua_offices')->insert([
            [
                'code'        => 'DO',
                'description' => 'Dummy Office'
            ]
        ]);


        DB::table('dtr_lgu_nabua_positions')->insert([
            [
                'title'       => 'DP',
                'description' => 'Dummy Position'
            ]
        ]);

        DB::table('dtr_lgu_nabua_employees')->insert([
            [
                'title'         => 'Engr.',
                'first_name'    => 'Juan',
                'middle_name'   => 'Reyes',
                'last_name'     => 'Dela Cruz',
                'name_suffix'   => 'Jr.',
                'is_male'       => 1,
                'date_of_birth' => '1990-01-01'
            ]
        ]);

        DB::table('dtr_lgu_nabua_designations')->insert([
            [
                'office_id'   => 1,
                'position_id' => 1,
                'employee_id' => 1,
                'date'         => '2021-01-01',
                'type'         => 'Regular',
            ]
        ]);

        DB::table('dtr_lgu_nabua_accounts')->insert([
            [
                'employee_id' => 1,
                'code'      => 'test',
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
        //
    }
};
