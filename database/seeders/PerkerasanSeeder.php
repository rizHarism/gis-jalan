<?php

namespace Database\Seeders;

use App\Models\Perkerasan;
use Illuminate\Database\Seeder;

class PerkerasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //SEED PERKERASAN JALAN FROM MASTER_PERKERASAN.CSV
        Perkerasan::truncate();

        $csvFile = fopen(base_path("database/data-seeder/master_perkerasan.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Perkerasan::create([
                    "perkerasan" => $data["1"],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
