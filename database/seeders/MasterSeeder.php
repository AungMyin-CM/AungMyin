<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Master;
use File;


class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Master::truncate();
  
        $json = File::get("database/data/master.json");
        $countries = json_decode($json);
  
        foreach ($countries as $key => $value) {
            Master::create([
                "key" => $value->key,
                "value" => $value->value
            ]);
        }
    }
}

