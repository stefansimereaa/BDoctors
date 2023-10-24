<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)

    {
        $data = $request->all();
        $rating = new Rating;
        $rating->fill($data);
        $timestamp = now();
        $rating['date'] = $timestamp;
        $rating->save();
        $user_id = $data['doctor_id'];
        $doctor = Doctor::findOrFail($user_id);
        $doctor->ratings()->attach($rating);
    }
}
