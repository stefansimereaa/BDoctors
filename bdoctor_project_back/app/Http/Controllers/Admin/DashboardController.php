<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Review;
use App\Models\Doctor;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::id();
        $doctor = Doctor::findOrFail($user_id);
        $messages = Message::where('doctor_id', '=', $user_id)->get();
        $ratings = $doctor->ratings()->get();
        // dd($ratings);
        $reviews = Review::where('doctor_id', '=', $user_id)->get();
        foreach ($reviews as $review) {
            $date = Carbon::parse($review->created_at);
            if ($date->month === 2 && $date->year === 2023) {
                // $ratingsFeb2023[] = $date->format('Y-m-d');

            }
        };
        //! Novembre 2022
        // Voti
        $ratingsNov2022 = [];
        foreach ($ratings as $rating) {
            $date = Carbon::parse($rating->date);
            if ($date->month === 11 && $date->year === 2022) {
                $ratingsNov2022[] = $date->format('Y-m-d');
            }
        };
        // Recensioni 
        $reviewsNov2022 = [];
        foreach ($reviews as $review) {
            $date = Carbon::parse($review->date);
            if ($date->month === 11 && $date->year === 2022) {
                $reviewsNov2022[] = $date->format('Y-m-d');
            }
        };
        // Messaggi
        $messagesNov2022 = Message::where('doctor_id', $user_id)
            ->whereMonth('date', 11)
            ->whereYear('date', 2022)
            ->get();

        //! Dicembre 2022
        // Voti
        $ratingsDic2022 = [];
        foreach ($ratings as $rating) {
            $date = Carbon::parse($rating->date);
            if ($date->month === 12 && $date->year === 2022) {
                $ratingsDic2022[] = $date->format('Y-m-d');
            }
        };
        // Recensioni 
        $reviewsDic2022 = [];
        foreach ($reviews as $review) {
            $date = Carbon::parse($review->date);
            if ($date->month === 12 && $date->year === 2022) {
                $reviewsDic2022[] = $date->format('Y-m-d');
            }
        };
        // Messaggi
        $messagesDic2022 = Message::where('doctor_id', $user_id)
            ->whereMonth('date', 12)
            ->whereYear('date', 2022)
            ->get();
        //! Gennaio 2023 
        // Voti
        $ratingsGen2023 = [];
        foreach ($ratings as $rating) {
            $date = Carbon::parse($rating->date);
            if ($date->month === 1 && $date->year === 2023) {
                $ratingsGen2023[] = $date->format('Y-m-d');
            }
        };
        // Recensioni 
        $reviewsGen2023 = [];
        foreach ($reviews as $review) {
            $date = Carbon::parse($review->date);
            if ($date->month === 1 && $date->year === 2023) {
                $reviewsGen2023[] = $date->format('Y-m-d');
            }
        };
        // Messaggi
        $messagesGen2023 = Message::where('doctor_id', $user_id)
            ->whereMonth('date', 1)
            ->whereYear('date', 2023)
            ->get();

        //! Febbraio 2023
        $ratingsFeb2023 = [];
        // Voti
        foreach ($ratings as $rating) {
            $date = Carbon::parse($rating->date);
            if ($date->month === 2 && $date->year === 2023) {
                $ratingsFeb2023[] = $date->format('Y-m-d');
            }
        };
        // Recensioni 
        $reviewsFeb2023 = [];
        foreach ($reviews as $review) {
            $date = Carbon::parse($review->date);
            if ($date->month === 2 && $date->year === 2023) {
                $reviewsFeb2023[] = $date->format('Y-m-d');
            }
        };
        // Messaggi
        $messagesFeb2023 = Message::where('doctor_id', $user_id)
            ->whereMonth('date', 2)
            ->whereYear('date', 2023)
            ->get();

        //! Marzo 2023
        // Voti
        $ratingsMar2023 = [];
        foreach ($ratings as $rating) {
            $date = Carbon::parse($rating->date);
            if ($date->month === 3 && $date->year === 2023) {
                $ratingsMar2023[] = $date->format('Y-m-d');
            }
        };
        // Recensioni 
        $reviewsMar2023 = [];
        foreach ($reviews as $review) {
            $date = Carbon::parse($review->date);
            if ($date->month === 3 && $date->year === 2023) {
                $reviewsMar2023[] = $date->format('Y-m-d');
            }
        };
        // Messaggi 
        $messagesMar2023 = Message::where('doctor_id', $user_id)
            ->whereMonth('date', 3)
            ->whereYear('date', 2023)
            ->get();

        //! Aprile 2023
        // Voti
        $ratingsApr2023 = [];
        foreach ($ratings as $rating) {
            $date = Carbon::parse($rating->date);
            if ($date->month === 4 && $date->year === 2023) {
                $ratingsApr2023[] = $date->format('Y-m-d');
            }
        };
        // Recensioni 
        $reviewsApr2023 = [];
        foreach ($reviews as $review) {
            $date = Carbon::parse($review->date);
            if ($date->month === 4 && $date->year === 2023) {
                $reviewsApr2023[] = $date->format('Y-m-d');
            }
        };
        // Messaggi 
        $messagesApr2023 = Message::where('doctor_id', $user_id)
            ->whereMonth('date', 4)
            ->whereYear('date', 2023)
            ->get();

        //! Maggio 2023
        // Voti
        $ratingsMag2023 = [];
        foreach ($ratings as $rating) {
            $date = Carbon::parse($rating->date);
            if ($date->month === 5 && $date->year === 2023) {
                $ratingsMag2023[] = $date->format('Y-m-d');
            }
        };
        // Recensioni 
        $reviewsMag2023 = [];
        foreach ($reviews as $review) {
            $date = Carbon::parse($review->date);
            if ($date->month === 5 && $date->year === 2023) {
                $reviewsMag2023[] = $date->format('Y-m-d');
            }
        };
        // Messaggi 
        $messagesMag2023 = Message::where('doctor_id', $user_id)
            ->whereMonth('date', 5)
            ->whereYear('date', 2023)
            ->get();

        //! Giugno 2023
        // Voti
        $ratingsGiu2023 = [];
        foreach ($ratings as $rating) {
            $date = Carbon::parse($rating->date);
            if ($date->month === 6 && $date->year === 2023) {
                $ratingsGiu2023[] = $date->format('Y-m-d');
            }
        };
        // Recensioni 
        $reviewsGiu2023 = [];
        foreach ($reviews as $review) {
            $date = Carbon::parse($review->date);
            if ($date->month === 6 && $date->year === 2023) {
                $reviewsGiu2023[] = $date->format('Y-m-d');
            }
        };
        // Messaggi 
        $messagesGiu2023 = Message::where('doctor_id', $user_id)
            ->whereMonth('date', 6)
            ->whereYear('date', 2023)
            ->get();
        //! Luglio 2023
        // Voti
        $ratingsLug2023 = [];
        foreach ($ratings as $rating) {
            $date = Carbon::parse($rating->date);
            if ($date->month === 7 && $date->year === 2023) {
                $ratingsLug2023[] = $date->format('Y-m-d');
            }
        };
        // Recensioni 
        $reviewsLug2023 = [];
        foreach ($reviews as $review) {
            $date = Carbon::parse($review->date);
            if ($date->month === 7 && $date->year === 2023) {
                $reviewsLug2023[] = $date->format('Y-m-d');
            }
        };
        // Messaggi
        $messagesLug2023 = Message::where('doctor_id', $user_id)
            ->whereMonth('date', 7)
            ->whereYear('date', 2023)
            ->get();

        //! Agosto 2023
        // Voti
        $ratingsAug2023 = [];
        foreach ($ratings as $rating) {
            $date = Carbon::parse($rating->date);
            if ($date->month === 8 && $date->year === 2023) {
                $ratingsAgo2023[] = $date->format('Y-m-d');
            }
        };
        // Recensioni 
        $reviewsAug2023 = [];
        foreach ($reviews as $review) {
            $date = Carbon::parse($review->date);
            if ($date->month === 8 && $date->year === 2023) {
                $reviewsAug2023[] = $date->format('Y-m-d');
            }
        };
        // Messaggi
        $messagesAug2023 = Message::where('doctor_id', $user_id)
            ->whereMonth('date', 8)
            ->whereYear('date', 2023)
            ->get();

        //! Settembre 2023
        // Voti
        $ratingsSet2023 = [];
        foreach ($ratings as $rating) {
            $date = Carbon::parse($rating->date);
            if ($date->month === 9 && $date->year === 2023) {
                $ratingsSet2023[] = $date->format('Y-m-d');
            }
        };
        // Recensioni 
        $reviewsSet2023 = [];
        foreach ($reviews as $review) {
            $date = Carbon::parse($review->date);
            if ($date->month === 9 && $date->year === 2023) {
                $reviewsSet2023[] = $date->format('Y-m-d');
            }
        };
        // Messaggi
        $messagesSet2023 = Message::where('doctor_id', $user_id)
            ->whereMonth('date', 9)
            ->whereYear('date', 2023)
            ->get();

        //! Ottobre 2023
        // Voti
        $ratingsOtt2023 = [];
        foreach ($ratings as $rating) {
            $date = Carbon::parse($rating->date);
            if ($date->month === 10 && $date->year === 2023) {
                $ratingsOtt2023[] = $date->format('Y-m-d');
            }
        };
        // Recensioni 
        $reviewsOtt2023 = [];
        foreach ($reviews as $review) {
            $date = Carbon::parse($review->date);
            if ($date->month === 10 && $date->year === 2023) {
                $reviewsOtt2023[] = $date->format('Y-m-d');
            }
        };
        // Messaggi
        $messagesOtt2023 = Message::where('doctor_id', $user_id)
            ->whereMonth('date', 10)
            ->whereYear('date', 2023)
            ->get();


        return view('admin.admin', compact(
            'ratings',
            'ratingsGen2023',
            'ratingsFeb2023',
            'ratingsMar2023',
            'ratingsApr2023',
            'ratingsMag2023',
            'ratingsGiu2023',
            'ratingsLug2023',
            'ratingsAug2023',
            'ratingsSet2023',
            'ratingsOtt2023',
            'ratingsNov2022',
            'ratingsDic2022',
            'doctor',
            'messages',
            'messagesNov2022',
            'messagesDic2022',
            'messagesGen2023',
            'messagesFeb2023',
            'messagesMar2023',
            'messagesApr2023',
            'messagesMag2023',
            'messagesGiu2023',
            'messagesLug2023',
            'messagesAug2023',
            'messagesSet2023',
            'messagesOtt2023',
            'reviews',
            'reviewsNov2022',
            'reviewsDic2022',
            'reviewsGen2023',
            'reviewsFeb2023',
            'reviewsMar2023',
            'reviewsApr2023',
            'reviewsMag2023',
            'reviewsGiu2023',
            'reviewsLug2023',
            'reviewsAug2023',
            'reviewsSet2023',
            'reviewsOtt2023',

        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
