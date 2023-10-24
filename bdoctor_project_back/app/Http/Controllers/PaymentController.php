<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Sponsor;
use App\Models\Payment;
use App\Models\User;
use Braintree\Gateway;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Doctor $doctor)
    {
        $user_id = Auth::id();
        $doctor = Doctor::findOrFail($user_id);

        $sponsors = Sponsor::all();
        return view('payments.index', compact('doctor', 'sponsors'));
    }
    // Payment function to send a payment request 
    public function store(Request $request)
    {
        $user = Auth::id();
        $doctor = Doctor::findOrFail($user);
        $sponsor = Sponsor::findOrFail($request->sponsor);
        // Even if is already checked, i did another check to see if the doctor who sent the request is the same of the doctor whos logged in 
        if ($doctor->id == $request->doctor) {

            // I took the id of the sponsorship requested
            $sponsorship = $request->sponsor;
            // Calculate the cost from the sponsorship requested
            $cost = $sponsor->cost;



            // if ($doctor->user_id != $user) {
            //     return view('notAuthorized');
            // }

            $payload = $request->input('payload', false);

            $gateway = new Gateway([
                'environment' => 'sandbox',
                'merchantId' => '837hcd35nzkx3c3x',
                'publicKey' => 'bf57n7wd4pz7xjh3',
                'privateKey' => '4c0b31e8dc061d3e0ed7288a129ba5cf',
            ]);

            $result = $gateway->transaction()->sale([
                'amount' => $cost,
                'paymentMethodNonce' => $request->payment_method_nonce,
            ]);

            if ($result->success) {
                // Take current time 
                $currentTimestamp = time();
                // Calculate timestamp for sponsorship type
                $expirationTimestamp = null;
                if ($sponsorship == 1) $expirationTimestamp = $currentTimestamp + 86400;
                else if ($sponsorship == 2) $expirationTimestamp = $currentTimestamp + 259200;
                else if ($sponsorship == 3) $expirationTimestamp = $currentTimestamp + 518400;
                // Format the next day timestamp as a date and time string
                $nextDayString = date('Y-m-d H:i:s', $expirationTimestamp);

                // Attach all the infos in the sponsors pivot table 
                $doctor->sponsors()->attach($sponsor, ['expiration' => $nextDayString]);


                return to_route('admin.admin')->with('type', 'payment')->with('message', 'Payment successful')->with('alert', 'success');
            } else {
                return 'Transaction declined. Reason: ' . $result->message;
            }
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);
        $sponsor = Sponsor::findOrFail($id);
        $doctor = $request->query('doctor');
        return view('payments.show', compact('sponsor', 'doctor', 'user'));
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
