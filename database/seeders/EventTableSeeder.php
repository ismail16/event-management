<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Enums\UserStatus;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $event = new Event();
        $event->fill([
            'name' => 'Event',
            'venue' => 'AC22',
            'email' => 'event@octaglory.com',
            'phone' => '+8801611111111',
            'event_start_date' => Carbon::now(),
            'event_end_date' => Carbon::now(),
            'reg_start_date' => Carbon::now(),
            'reg_end_date' => Carbon::now(),
            'organization' => 'Octaglory',
            'max_participant' => 10,
            'contact' => 'contact@octaglory.com'
        ]);
        $event->save();
    }
}
