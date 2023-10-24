<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Sponsor;
use Carbon\Carbon;

class SponsorshipSeeder extends Seeder
{
    public function run()
    {
        $doctors = Doctor::all();
        $sponsors = Sponsor::all();

        // Loop through each doctor and associate them with a sponsor
        $doctors->each(function ($doctor) use ($sponsors) {
            if (rand(0, 1)) {

                // Get a random sponsor
                $sponsor = $sponsors->random();

                // Calculate the expiration date (one day after the created_at of the sponsor)
                $created_at = Carbon::parse($sponsor->created_at);
                $expirationDate = $created_at->addDay();

                // Attach the sponsor to the doctor with the updated expiration date
                $doctor->sponsors()->attach([$sponsor->id => ['expiration' => $expirationDate]]);
            }
        });
    }
}
