<?php

namespace App\Repositories;

use App\Enums\Role;
use Illuminate\Support\Facades\Auth;

class EventRepository
{
    public function getEvents($builder, $request)
    {
        $events = $builder->orderBy('created_at');
        $user   = Auth::user();

        if (!$user) {
            throw new \Exception('Authentication error');
        }

        if (!count($user->roles) || (count($user->roles) && $user->roles[0] == Role::STUDENT)) {
            return collect([]);
        }

        if ($user->roles[0] != Role::SUPER_ADMIN && $user->roles[0] != Role::MANAGEMENT_ADMIN) {
            return $user->memberOf()->orderBy('created_at')->paginate($request->get('per-page', 10));
        }

        return $events->paginate($request->get('per-page', 10));
    }
}
