<?php

namespace App\Jobs;

use App\Models\Registration;
use App\Sms\Facades\SMS;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendRegistrationSuccessSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Registration $registration;

    public function __construct(Registration $registration)
    {
        $this->registration = $registration;
        $this->registration->load(['event', 'payment']);
    }

    public function handle()
    {
        SMS::send($this->registration->phone, sprintf(
            "Dear Ofn %s,Payment BDT %u Received.Thank you for confirming your participation in %s. See you on 1st April at %s.-OFA",
            $this->registration->name,
            $this->registration->payment->amount,
            $this->registration->event->name,
            $this->registration->event->venue,
        ));
    }
}
