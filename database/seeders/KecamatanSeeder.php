<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //SEED KECAMATAN FROM MASTER_KECAMATAN.CSV
        Kecamatan::truncate();

        $csvFile = fopen(base_path("database/data-seeder/master_kecamatan.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Kecamatan::create([
                    "nama" => $data["1"],
                    "kode_kecamatan" => $data["2"],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
