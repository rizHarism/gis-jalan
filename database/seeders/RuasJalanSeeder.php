<?php

namespace Database\Seeders;

use App\Models\RuasJalan;
use Illuminate\Database\Seeder;

class RuasJalanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //SEED RUAS JALAN FROM MASTER_RUAS_JALAN.CSV
        RuasJalan::truncate();

        $csvFile = fopen(base_path("database/data-seeder/master_ruas_jalan_line.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                RuasJalan::create([
                    "nomor_ruas" => $data["1"],
                    "nama_ruas" => $data["2"],
                    "pangkal_ruas" => $data["3"],
                    "ujung_ruas" => $data["4"],
                    "lingkungan" => $data["5"],
                    "kelurahan_id" => $data["6"],
                    "kecamatan_id" => $data["9"],
                    "panjang" => $data["12"],
                    "lebar" => $data["13"],
                    "bahu_jalan" => $data["14"],
                    "perkerasan_id" => $data["15"],
                    "kondisi_id" => $data["17"],
                    "utilitas" => $data["19"],
                    "start_x" => $data["20"],
                    "start_y" => $data["21"],
                    "middle_x" => $data["22"],
                    "middle_y" => $data["23"],
                    "end_x" => $data["24"],
                    "end_y" => $data["25"],
                    "geometry" => $data["26"],
                    "image" => $data["27"],

                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
