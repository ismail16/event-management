<?php

namespace App\Jobs;

use App\Mail\EventTicket;
use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEventTicketMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $email;
    public Registration $registration;
    public function __construct(string $email, Registration $registration)
    {
        $this->email = $email;
        $this->registration = $registration;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Log::debug('Email Sending Initiated: '.$this->email);
            Mail::to($this->email)
                ->queue(new EventTicket($this->registration));
        }
        catch (\Throwable $e){
            Log::error('Email Sending Failed: '.$e->getMessage());
        }

    }
}
