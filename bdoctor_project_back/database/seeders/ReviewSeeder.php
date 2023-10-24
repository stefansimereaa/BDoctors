<?php

namespace Database\Seeders;

use App\Models\Review;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        // Possibili recensioni da fare
        $reviews = [
            "Il Dottor Francesco è un medico molto competente. Mi ha fornito una diagnosi accurata e ha spiegato chiaramente il piano di trattamento. Sono molto soddisfatto del suo servizio. Consigliato!",
            "Ho avuto il piacere di consultare il Dottor Johnson. È un professionista eccezionale e ha una grande empatia verso i suoi pazienti. Le sue cure hanno migliorato notevolmente la mia salute. Lo consiglio vivamente a tutti.",
            "Sono rimasta molto impressionata dal Dottor Lee. È un medico molto attento e ha un approccio gentile. Le sue spiegazioni sono state chiare e rassicuranti. Grazie per il supporto.",
            "Il Dottor Garcia è un medico eccezionale. Ha affrontato il mio problema di salute con grande professionalità e attenzione. Sono davvero grato per la sua cura. Lo sceglierei di nuovo.",
            "Ho avuto la fortuna di essere assistita dal Dottor Kim. È un medico eccezionale che si prende cura dei suoi pazienti con grande attenzione. Grazie per il tuo impegno costante.",
            "Il Dottor Davis è sempre stato puntuale e professionale. Ha risposto a tutte le mie domande e ha fornito un'ottima assistenza. Grazie per tutto.",
            "Sono molto soddisfatta del Dottor Martinez. È stato gentile e ha ascoltato attentamente le mie preoccupazioni. Ha fornito una diagnosi accurata e un trattamento efficace.",
            "Il Dottor Wilson è un medico compassionevole e competente. Durante il mio periodo di malattia, ha fornito un grande sostegno e cura. Lo consiglio vivamente.",
            "Ho avuto una grande esperienza con il Dottor Adams. È sempre stato disponibile e affidabile. Mi ha aiutato a comprendere la mia salute. Grazie mille!",
            "Il Dottor Hall è eccezionale. Ha una conoscenza approfondita e un approccio empatico. Sono molto grato per l'ottima cura che ho ricevuto. Consigliato!",
            "Il Dottor Smith è un medico molto competente. Mi ha fornito una diagnosi accurata e ha spiegato chiaramente il piano di trattamento. Sono molto soddisfatto del suo servizio. Consigliato!",
            "Ho avuto il piacere di consultare il Dottor Johnson. È un professionista eccezionale e ha una grande empatia verso i suoi pazienti. Le sue cure hanno migliorato notevolmente la mia salute. Lo consiglio vivamente a tutti.",
            "Sono rimasta molto impressionata dal Dottor Lee. È un medico molto attento e ha un approccio gentile. Le sue spiegazioni sono state chiare e rassicuranti. Grazie per il supporto.",
            "Il Dottor Garcia è un medico eccezionale. Ha affrontato il mio problema di salute con grande professionalità e attenzione. Sono davvero grato per la sua cura. Lo sceglierei di nuovo.",
            "Ho avuto la fortuna di essere assistita dal Dottor Kim. È un medico eccezionale che si prende cura dei suoi pazienti con grande attenzione. Grazie per il tuo impegno costante.",
            "Il Dottor Smith è sempre stato puntuale e professionale. Ha risposto a tutte le mie domande e ha fornito un'ottima assistenza. Grazie per tutto.",
            "Sono molto soddisfatta del Dottor Martinez. È stato gentile e ha ascoltato attentamente le mie preoccupazioni. Ha fornito una diagnosi accurata e un trattamento efficace.",
            "Il Dottor Wilson è un medico compassionevole e competente. Durante il mio periodo di malattia, ha fornito un grande sostegno e cura. Lo consiglio vivamente.",
            "Ho avuto una grande esperienza con il Dottor Adams. È sempre stato disponibile e affidabile. Mi ha aiutato a comprendere la mia salute. Grazie mille!",
            "Il Dottor Hall è eccezionale. Ha una conoscenza approfondita e un approccio empatico. Sono molto grato per l'ottima cura che ho ricevuto. Consigliato!",
            "Ho avuto il privilegio di essere paziente del Dottor Smith. È davvero un professionista di alto livello. La sua attenzione ai dettagli è impressionante.",
            "Il Dottor Johnson è il mio medico di fiducia. Si prende cura di me e della mia famiglia da anni. È estremamente competente e comprensivo.",
            "Ho avuto una grande esperienza con il Dottor Lee. È molto gentile e ha risposto a tutte le mie domande con pazienza. Lo raccomanderei a chiunque.",
            "Il Dottor Garcia è un medico straordinario. Ha un approccio umano e competente alla cura dei pazienti. Grazie per tutto ciò che fai!",
            "Sono molto grata al Dottor Kim per il suo impegno costante nella mia salute. È sempre disponibile e attento alle mie esigenze.",
            "Il Dottor Davis è il miglior medico che abbia mai incontrato. È altamente competente e mette sempre i pazienti al primo posto.",
            "Il Dottor Martinez è molto competente e gentile. Ha risolto il mio problema di salute con successo. Sono molto soddisfatta del suo servizio.",
            "Il Dottor Wilson è un medico eccellente. Ha una grande esperienza e mi ha aiutato a superare una malattia difficile. Grazie per la tua dedizione.",
            "Ho avuto il piacere di essere paziente del Dottor Adams. È sempre gentile e disponibile. Le sue spiegazioni sono chiare e comprensibili.",
            "Il Dottor Hall è un vero professionista. Ha affrontato la mia situazione con competenza e attenzione. Sono molto soddisfatto dei risultati.",
            "Ho consultato il Dottor Johnson e sono rimasta colpita dalla sua professionalità. Ha affrontato il mio problema di salute con grande competenza. Consiglio vivamente!",
            "Il Dottor Garcia è un medico straordinario. La sua dedizione ai pazienti è evidente. Sono grato per il suo supporto durante la mia malattia.",
            "Ho avuto una grande esperienza con il Dottor Kim. È sempre disponibile e ha risolto i miei problemi di salute in modo efficace. Grazie!",
            "Il Dottor Davis è stato un grande aiuto per me. La sua competenza e l'attenzione ai dettagli sono notevoli. Consiglio vivamente il suo servizio.",
            "Sono molto soddisfatta del Dottor Martinez. Ha fornito una diagnosi accurata e il trattamento ha funzionato alla perfezione. Grazie per tutto!",
            "Il Dottor Wilson è un medico eccezionale. Ha aiutato me e la mia famiglia in molte occasioni. È altamente raccomandato.",
            "Ho avuto una grande esperienza con il Dottor Adams. È sempre stato gentile e disponibile. Mi ha aiutato a comprendere meglio la mia salute. Grazie mille!",
            "Il Dottor Hall è eccezionale. Ha una vasta conoscenza medica e un approccio empatico. Sono grato per il suo sostegno.",
            "Ho consultato il Dottor Smith e sono rimasto colpito dalla sua professionalità. Ha affrontato i miei problemi di salute con successo. Consiglio vivamente.",
            "Sono stata paziente del Dottor Johnson per anni. È un medico eccezionale che si prende cura dei suoi pazienti con attenzione. Grazie per tutto ciò che fai!"
        ];
        for ($i = 0; $i < 1000; $i++) {
            // Estrae le reviews text e le randomizza per 100 recensioni
            $randomReview = $reviews[array_rand($reviews)];
            // Estrae il nome del dottore dalla recensione
            preg_match('/(?:Dottor|Dottore)\s+(\w+)/i', $randomReview, $matches);
            $doctorName = isset($matches[1]) ? $matches[1] : 'Nome Dottore Sconosciuto';
            $review = new Review();
            $review->doctor_id = $faker->numberBetween(1, 50);
            $review->name = $doctorName;
            $review->text = $randomReview;
            $review->email = $faker->email();

            //Date comprese in un anno
            $startDate = '2022-11-01T00:00:00';
            $endDate = '2023-10-31T23:59:59';
            $review->date = $faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d H:i:s');

            $review->save();
        }
    }
}
