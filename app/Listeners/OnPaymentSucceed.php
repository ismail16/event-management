<?php

namespace App\Listeners;

use App\Jobs\SendEventTicketMail;
use App\Jobs\SendPaymentSuccessSms;

class OnPaymentSucceed
{
    public function handle($event): void
    {
        $payment = $event->payment;

        $registrationEvent = $payment->event;
        $registration      = $payment->registration;

        $registrationEventEmail = $registrationEvent->email;
        $registrationEmail      = $registration->email;

        SendEventTicketMail::dispatch($registrationEventEmail, $registration);
        SendEventTicketMail::dispatch($registrationEmail, $registration);

        SendPaymentSuccessSms::dispatch($registration);
    }
}
