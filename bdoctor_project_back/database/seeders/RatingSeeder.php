<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Rating;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 1000; $i++) {
            $vote = new Rating();
            $vote->vote = $faker->numberBetween(1, 5);

            //Date comprese in un anno
            $startDate = '2022-11-01T00:00:00';
            $endDate = '2023-10-31T23:59:59';
            $vote->date = $faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d H:i:s');

            $vote->save();
        }
    }
}
