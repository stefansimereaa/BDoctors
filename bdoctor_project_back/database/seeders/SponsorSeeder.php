<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use App\Models\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        // Creazione di 3 sponsor
        for ($i = 0; $i < 3; $i++) {
            $sponsor = new Sponsor();

            // setta il nome e il costo di ogni sponsor
            if ($i === 0) {
                $sponsor->name = 'Silver';
                $sponsor->cost = 2.99;
                $sponsor->type = 'Con la sponsorship Silver, garantiamo ai dottori un posto in cima alle ricerche. Quando un utente cerca, il tuo profilo sarà tra le prime opzioni visualizzate, aumentando notevolmente la visibilità della tua pratica medica. Scegli la sponsorship Silver per raggiungere un pubblico più ampio e mettere in evidenza la tua professionalità. La durata della Sponsorizzazione sarà di 24 ore.';
            } elseif ($i === 1) {
                $sponsor->name = 'Gold';
                $sponsor->cost = 5.99;
                $sponsor->type = 'La sponsorship Gold è la scelta ideale per i dottori che cercano una visibilità premium. Con questa opzione, il tuo profilo sarà posizionato in cima alle ricerche, garantendo una massima esposizione. Inoltre, offriamo servizi aggiuntivi, come la possibilità di evidenziare il tuo profilo e promuovere le tue specializzazioni in modo più evidente. Con la sponsorship Gold, avrai un vantaggio competitivo, attirando un maggior numero di pazienti e consolidando la tua reputazione nel campo medico. La durata della Sponsorizzazione sarà di 72 ore.';
            } else {
                $sponsor->name = 'Platinum';
                $sponsor->cost = 9.99;
                $sponsor->type = "La sponsorship Platinum è la scelta definitiva per i dottori che cercano la massima visibilità e prestigio. Con questa opzione, il tuo profilo sarà posizionato al vertice delle ricerche, garantendo un'eccezionale esposizione e una visibilità senza rivali. Permettiamo inoltre di personalizzare in modo dettagliato il tuo profilo, evidenziando le tue competenze e le tue specializzazioni in modo straordinario. Con la sponsorship Platinum, otterrai una visibilità suprema, attirando un flusso costante di pazienti di alta qualità e rafforzando la tua posizione come leader nel campo medico. La durata della Sponsorizzazione sarà di 144 ore.";
            }


            $sponsor->save();
        }
    }
}
