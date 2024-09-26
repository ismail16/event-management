<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Mail\EventTicket;
use App\Models\Payment;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{

    public function pay(PaymentRequest $request)
    {
        $registration = Registration::wherePhone($request->get('phone'))
            ->firstOrFail();

        $email = $registration->email;

        // will move into payment complete event listener
        DB::afterCommit(static function() use ($email, $registration){
            Mail::to($email)->queue(new EventTicket($registration));
        });
    }
}
