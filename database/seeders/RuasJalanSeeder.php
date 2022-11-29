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
                    "bahu_kanan" => $data["14"],
                    "bahu_kiri" => $data["15"],
                    "perkerasan_id" => $data["16"],
                    "kondisi_id" => $data["18"],
                    "utilitas" => $data["20"],
                    "start_x" => $data["21"],
                    "start_y" => $data["22"],
                    "middle_x" => $data["23"],
                    "middle_y" => $data["24"],
                    "end_x" => $data["25"],
                    "end_y" => $data["26"],
                    "geometry" => $data["27"],
                    "image" => $data["28"],

                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
