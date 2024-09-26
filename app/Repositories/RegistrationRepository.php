<?php

namespace App\Repositories;

use Illuminate\Support\Carbon;

class RegistrationRepository
{
    public function list($query, $request)
    {
        $event    = $request->get('filter-event');
        $status   = $request->get('filter-status');
        $search   = $request->get('search');
        $fromDate = $request->get('from_date', date("Y-m-d", 946684800));
        $toDate   = $request->get('to_date', date("Y-m-d"));
        $fromDate = Carbon::createFromFormat("Y-m-d", $fromDate)->startOfDay();
        $toDate   = Carbon::createFromFormat("Y-m-d", $toDate)->endOfDay();

        if ($event) {
            $query->where('event_id', '=', $event);
        }

        if ($status) {
            $query->whereHas('payment', function ($q) use ($status) {
                $q->where('payments.status', '=', $status);
            });
        }

        if ($search) {
            $query->where('name', 'LIKE', "%$search%")
                ->orWhere('phone', 'LIKE', "%$search%")
                ->orWhereHas('payment', function ($q) use ($search) {
                    $q->where('payments.transaction_id', 'LIKE', "%$search%");
                });
        }

        $query->where('created_at', '>=', $fromDate)->where('created_at', '<=', $toDate);

        return $query->with(['payment'])->orderBy('created_at', 'DESC')->paginate(50);
    }
}
