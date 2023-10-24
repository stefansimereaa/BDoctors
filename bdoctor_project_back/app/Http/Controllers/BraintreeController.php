<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Sponsor;
use Braintree\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BraintreeController extends Controller
{
    public function payment(Request $request, Doctor $doctor)
    {
        dd($doctor);
        $user = Auth::id();
        $sponsors = Sponsor::all();
        $type1 = $sponsors[0]->cost;
        $type2 = $sponsors[1]->cost;
        $type3 = $sponsors[2]->cost;
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
            // 'amount' => $type,
            'amount' => '150.00',
            'paymentMethodNonce' => $request->payment_method_nonce,
        ]);

        if ($result->success) {
            return to_route('admin.admin')->with('type', 'payment')->with('message', 'Payment successful')->with('alert', 'success');
        } else {
            return 'Transaction declined. Reason: ' . $result->message;
        }
    }
}
