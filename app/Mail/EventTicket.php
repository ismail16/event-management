<?php

namespace App\Mail;

use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventTicket extends Mailable
{
    use Queueable, SerializesModels;

    private Registration $registration;

    public function __construct(Registration $registration)
    {
        $this->registration = $registration;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $kidsBelowSix      = [];
        $kidsAboveSix      = [];
        $countKidsBelowSix = 0;
        $countKidsAboveSix = 0;

        $this->registration->load(['payment', 'guests', 'event']);
        $this->registration->guests()->each(function ($guest) use (
            &$countKidsBelowSix,
            &$countKidsAboveSix,
            &$kidsBelowSix,
            &$kidsAboveSix
        ) {
            if ($guest->type == Registration::TYPE_GUEST_KID_ABOVE || $guest->type == Registration::TYPE_GUEST_KID_BELOW) {
                if ($guest->age <= 6) {
                    $countKidsBelowSix++;
                    $kidsBelowSix['name']   = $guest->name;
                    $kidsBelowSix['age']    = $guest->age;
                    $kidsBelowSix['amount'] = $guest->amount;

                } else {
                    $countKidsAboveSix++;
                    $kidsAboveSix['name']   = $guest->name;
                    $kidsAboveSix['age']    = $guest->age;
                    $kidsAboveSix['amount'] = $guest->amount;
                }
            }
        });

        $kidsBelowSix['quantity'] = $countKidsBelowSix;
        $kidsAboveSix['quantity'] = $countKidsAboveSix;

        return $this
            ->subject('')
            ->with([
                'registration'      => $this->registration,
                'payment'           => $this->registration->payment,
                'guests'            => $this->registration->guests,
                'event'             => $this->registration->event,
                'kidsBelowSix'      => $kidsBelowSix,
                'kidsAboveSix'      => $kidsAboveSix,
                'countKidsBelowSix' => $countKidsBelowSix,
                'countKidsAboveSix' => $countKidsAboveSix
            ])
            ->view('mail.event');
    }
}
