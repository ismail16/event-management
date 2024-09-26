<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;

class ApiEventRepository
{
    public function getEvents($builder, $request)
    {
        $events = $builder->orderBy('created_at');
        $user   = Auth::user();

        $this->applyFilters($events, $request);

        return $events->paginate($request->get('per-page', 20));
    }

    public function applyFilters($events, $request): void
    {
        $filter = $request->get('filter');
        $query  = urlencode($request->get('q'));

        switch ($filter) {
            case 'upcoming':
                $events->upcoming();
                break;
            case 'ongoing':
                $events->ongoing();
                break;
            case 'latest':
            default:
                $events->ended();
        }

        if ($query) {
            $events->where('events.name', 'LIKE', '%'.$query.'%')
                ->select('events.*')
                ->paginate($request->get('per_page', 50));
        }
    }

    public function search($builder, $request)
    {
        $query = urlencode($request->get('q'));

        return $builder->where('events.name', 'LIKE', '%'.$query.'%')
            ->select('events.*')
            ->paginate($request->get('per_page', 50));
    }
}
