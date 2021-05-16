<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stations')->insert(
            [
                'station_name' => 'Aluva',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('stations')->insert(
            [
                'station_name' => 'Pulinchodu',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('stations')->insert(
            [
                'station_name' => 'Companypady',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('stations')->insert(
            [
                'station_name' => 'Ambattukavu',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('stations')->insert(
            [
                'station_name' => 'Muttom',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('stations')->insert(
            [
                'station_name' => 'Kalamassery',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('stations')->insert(
            [
                'station_name' => 'Cochin University',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('stations')->insert(
            [
                'station_name' => 'Pathadipalam',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('stations')->insert(
            [
                'station_name' => 'Edapally',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('stations')->insert(
            [
                'station_name' => 'Changampuzha Park',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('stations')->insert(
            [
                'station_name' => 'Palarivattom',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('stations')->insert(
            [
                'station_name' => 'JLN Stadium',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('stations')->insert(
            [
                'station_name' => 'Kaloor',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('stations')->insert(
            [
                'station_name' => 'Town Hall',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('stations')->insert(
            [
                'station_name' => 'M.G. Road',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('stations')->insert(
            [
                'station_name' => 'Maharaja College',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('stations')->insert(
            [
                'station_name' => 'Ernakulam South',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('stations')->insert(
            [
                'station_name' => 'Kadavanthra',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('stations')->insert(
            [
                'station_name' => 'Elamkulam',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('stations')->insert(
            [
                'station_name' => 'Vytilla',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('stations')->insert(
            [
                'station_name' => 'Thykoodam',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('stations')->insert(
            [
                'station_name' => 'Petta',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );
    }
}
