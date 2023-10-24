<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DoctorController;
use App\Models\Doctor;
use App\Models\Specialization;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $doctor = Doctor::all();
        $specializations = Specialization::all();
        return view('auth.register', compact('doctor', 'specializations'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // @dd($request->specialization);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'specialization' => ['required', 'array', 'min:1'],
            'specialization.*' => ['required', 'numeric', 'distinct', 'min:1'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'specialization.required' => 'Atleast one specialization must be cheked',
        ]);

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $doctor = new Doctor();
        $doctor->address = $request->address;
        $doctor['user_id'] = $user->id;
        $doctor->save();
        foreach ($request['specialization'] as $specializations) {
            $doctor->specializations()->attach($specializations);
        }

        event(new Registered($user));

        Auth::login($user);



        return to_route('admin.doctor.edit', compact('doctor'));
    }
}
