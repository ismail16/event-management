<?php

namespace App\Exports;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Contracts\View\View;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromView;

class ParticipantExport implements FromView
{
    private $fromDate;
    private $toDate;
    private $registrations;
    private $events;


    public function __construct($fromDate, $toDate) {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->events = Event::all();
        $this->registrations = Registration::where('created_at', '>=', $fromDate)
           ->where('created_at', '<=', $toDate)
          ->get();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
      //  $fromDate = Carbon::createFromFormat("Y-m-d", $this->fromDate)->startOfDay();
       // $toDate = Carbon::createFromFormat("Y-m-d", $this->toDate)->endOfDay();

       // return Registration::where('created_at', '>=', $fromDate)
         //   ->where('created_at', '<=', $toDate)
         //   ->get();
        return view('backend.participants.export', [
            'registrations' => $this-> registrations,
            'events' => $this-> events,

        ]);
    }
}
