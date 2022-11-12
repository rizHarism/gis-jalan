<?php

namespace Database\Seeders;

use App\Models\KondisiJalan;
use Illuminate\Database\Seeder;

class KondisiJalanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //SEED KONDISI JALAN FROM MASTER_KONDISI.CSV
        KondisiJalan::truncate();

        $csvFile = fopen(base_path("database/data-seeder/master_kondisi.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                KondisiJalan::create([
                    "kondisi" => $data["1"],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
