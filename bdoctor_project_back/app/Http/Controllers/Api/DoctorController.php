<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::with(['user', 'ratings', 'specializations', 'reviews', 'sponsors' => function ($query) {
            $query->select('expiration'); // Select the 'expiration' column from the pivot table
        }])
            ->has('sponsors')
            ->orderByDesc(function ($query) {
                $query->select('expiration')
                    ->from('doctor_sponsor')
                    ->whereColumn('doctors.id', 'doctor_sponsor.doctor_id')
                    ->orderByDesc('expiration')
                    ->limit(1);
            })
            ->paginate(5);

        return response()->json($doctors);
    }





    public function indexBySpecializations(string $id)
    {
        $specializationId = $id; // Replace with the desired specialization ID

        $doctors = Doctor::with(['user', 'ratings', 'specializations', 'reviews', 'sponsors' => function ($query) {
            $query->select('expiration'); // Select the 'expiration' column from the pivot table
        }])
            ->whereHas('specializations', function ($query) use ($specializationId) {
                $query->where('specializations.id', $specializationId);
            })
            ->orderByRaw('IFNULL((SELECT COUNT(*) FROM doctor_sponsor WHERE doctor_sponsor.doctor_id = doctors.id), 0) DESC')
            ->orderByDesc(function ($query) {
                $query->select('expiration')
                    ->from('doctor_sponsor')
                    ->whereColumn('doctors.id', 'doctor_sponsor.doctor_id')
                    ->orderByDesc('expiration')
                    ->limit(1);
            })
            ->paginate(20);

        return response()->json($doctors);
    }
    public function indexBySpecializationsAndRatingAndReviews(string $id, string $rating, int $minReviews = 0)
    {
        $specializationId = $id; // Replace with the desired specialization ID
        $minVote = $rating;

        $doctors = Doctor::with(['user', 'specializations', 'ratings', 'reviews', 'sponsors' => function ($query) {
            $query->select('expiration'); // Select the 'expiration' column from the pivot table
        }])
            ->select('doctors.*')
            ->leftJoin('reviews', 'doctors.id', '=', 'reviews.doctor_id')
            ->whereHas('specializations', function ($query) use ($specializationId) {
                $query->where('specializations.id', $specializationId);
            })
            ->groupBy('doctors.id')
            ->selectRaw('COUNT(reviews.id) as review_count')
            ->havingRaw('COUNT(reviews.id) >= ?', [$minReviews])
            ->orderByRaw('IFNULL((SELECT COUNT(*) FROM doctor_sponsor WHERE doctor_sponsor.doctor_id = doctors.id), 0) DESC')
            ->orderByDesc(function ($query) {
                $query->select('expiration')
                    ->from('doctor_sponsor')
                    ->whereColumn('doctors.id', 'doctor_sponsor.doctor_id')
                    ->orderByDesc('expiration')
                    ->limit(1);
            })
            ->get();

        $doctors = $doctors->filter(function ($doctor) use ($minVote) {
            $averageRating = $doctor->ratings()->avg('vote');
            return $averageRating >= $minVote;
        });

        $doctors = new LengthAwarePaginator(
            $doctors->values()->forPage(request()->input('page'), 20),
            $doctors->count(),
            20,
            null,
            ['path' => url()->current()]
        );

        return response()->json($doctors);
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
        $doctor = Doctor::with('ratings', 'specializations', 'reviews', 'user')->find($id);
        if (!$doctor) return response(null, 404);
        return response()->json($doctor);
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
