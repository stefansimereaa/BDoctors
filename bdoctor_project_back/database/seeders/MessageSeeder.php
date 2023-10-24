<?php

namespace Database\Seeders;

use App\Models\Message;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 1000; $i++) {
            $vote = new Message();
            $vote->doctor_id = rand(1, 50);
            $vote->name = $faker->name();
            $vote->last_name = $faker->lastName();
            $vote->text = $faker->text();
            $vote->email = $faker->email();

            //Date comprese in un anno
            $startDate = '2022-11-01T00:00:00';
            $endDate = '2023-10-31T23:59:59';
            $vote->date = $faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d H:i:s');

            $vote->save();
        }
    }
}
