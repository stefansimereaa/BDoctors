<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $specializations = [
            'Ginecologo',
            'Ortopedico',
            'Dermatologo',
            'Nutrizionista',
            'Psicologo',
            'Oculista',
            'Urologo',
            'Otorino',
            'Cardiologo',
            'Dentista',
        ];

        foreach ($specializations as $name) {
            $specialization = new Specialization();
            $specialization->name = $name;
            $specialization->description = $faker->text();
            $specialization->save();
        }
    }
}
