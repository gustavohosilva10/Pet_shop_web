<?php

use Illuminate\Database\Seeder;
use App\TypePets;

class typePetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypePets::firstOrCreate([
            "name" => 'Aves',
            "type" =>1,
        ]);

        TypePets::firstOrCreate([
            "name" => 'Cães',
            "type" =>2,
        ]);

        TypePets::firstOrCreate([
            "name" => 'Gatos',
            "type" =>3,
        ]);

        TypePets::firstOrCreate([
            "name" => 'Cobras',
            "type" =>4,
        ]);


    }
}
