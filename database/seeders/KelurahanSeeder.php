<?php

namespace Database\Seeders;

use App\Models\Kelurahan;
use Illuminate\Database\Seeder;

class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //SEED KECAMATAN FROM MASTER_KELURAHAN.CSV
        Kelurahan::truncate();

        $csvFile = fopen(base_path("database/data-seeder/master_kelurahan.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Kelurahan::create([
                    "nama" => $data["1"],
                    "kecamatan_id" => $data["2"],
                    // "kode_kecamatan" => $data["3"],
                    "kode_kelurahan" => $data["4"],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
