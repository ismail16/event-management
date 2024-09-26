<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Enums\UserStatus;
use App\Filters\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Event;
use App\Models\User;
use App\Traits\WrapInTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
    use WrapInTransaction;

    public function index(Request $request, UserFilter $filter)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->back();
        }

        if (count($user->roles) && $user->roles[0] != Role::SUPER_ADMIN) {
            return redirect()->back();
        }

        $usersQuery = User::orderBy('id', 'desc')->filter($filter);

        $users  = $usersQuery->paginate();
        $events = Event::all();
        $input  = $request->all();
        $roles  = trans('user.roles');

        return view('backend.users.index', compact(['users', 'input', 'roles', 'events']));
    }

    public function create()
    {
        $events = Event::all();
        $roles  = trans('user.roles');

        return view('backend.users.create', compact('roles', 'events'));
    }

    public function store(UserRequest $request)
    {
        try {
            return $this->wrapInTransaction(function ($request) {

                $user = new User();

                $user->first_name = $request->get('first_name');
                $user->last_name  = $request->get('last_name');
                $user->email      = $request->get('email');
                $user->phone      = $request->get('phone');
                $user->status     = UserStatus::ACTIVE;
                $user->password   = Hash::make($request->get('password'));

                $events = $request->get('events', []);

                if ($request->has('role')) {
                    $user->refresh();
                    $user->roles = [$request->get('role')];
                }

                $user->save();

                if (count($events) && $events[0] && $request->has('role')) {
                    $user->refresh();
                    foreach ($events as $event) {
                        $user->memberOf()->sync([$event => ['role' => $request->get("role")]]);
                    }
                }

                info('*****', [$user]);

                $user->save();

                return response()->json([
                    'success'     => 'User Successfully Created!',
                    'redirect_to' => route('users.index'),
                ]);
            }, $request);
        } catch (\Exception $e) {
            save_error_log($e);
            return response()->json([
                'error' => 'User Creation Failed!'
            ]);
        }
    }


    public function edit($id)
    {
        $statuses = trans('user.status');
        $roles    = trans('user.roles');
        $user     = User::findOrFail($id);
        // will change to multiple event
        // only 1 user per event for now
        $selectedEvent = $user->memberOf()->first();
        $events        = Event::all();

        return view('backend.users.edit', compact(
            'user', 'statuses', 'roles', 'events', 'selectedEvent'
        ));
    }

    public function update($id, UserRequest $request)
    {
        try {
            return $this->wrapInTransaction(function ($id, $request) {
                $user = User::findOrFail($id);
                $user->fill($request->all());

                if (!blank($request->get('password'))) {
                    $user->password = Hash::make($request->get('password'));
                }

                $user->save();
                $events = $request->get('events', []);

                if (count($events) && $events[0]) {
                    foreach ($events as $event) {
                        $user->memberOf()->sync([$event => ['role' => $request->get("role")]]);
                    }
                    $user->save();
                }

                if ($request->has('role')) {
                    $role        = $request->get('role');
                    $user->roles = [$role];
                    $user->save();

                    if ($role != Role::EVENT_ADMIN) {
                        $user->memberOf()->detach();
                    }
                }

                return response()->json([
                    'success'     => 'Successfully User Updated!',
                    'redirect_to' => route('users.index'),
                ]);
            }, $id, $request);
        } catch (\Exception $e) {
            save_error_log($e);
            return response()->json([
                'error' => 'Update Request Failed!',
            ]);
        }
    }
}
