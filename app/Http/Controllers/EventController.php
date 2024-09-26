<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\EventResource;
use App\Repositories\EventRepository;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;


class EventController extends Controller
{
    public function index(Request $request, EventRepository $eventRepository)
    {
        try {
            $events = $eventRepository->getEvents(Event::query(), $request);

            return view('backend.events.index', compact('events'));
        } catch (\Exception $e) {
            save_error_log($e);

            return redirect()->back();
        }
    }

    public function event(string $eventId): EventResource
    {
        $event = Event::findOrFail($eventId);

        return new EventResource($event);
    }

    public function create()
    {
        return view('backend.events.create');
    }

    public function store(StoreEventRequest $request)
    {
        try {
            return $this->wrapInTransaction(function ($request) {
                $event = new Event();
                $event->fill($request->all());
                if ($request->has('is_published')) {
                    $event->is_published = $request->get('is_published') === 'on';
                }
                if ($request->has('is_registration_allowed')) {
                    $event->is_registration_allowed = $request->get('is_registration_allowed') === 'on';
                }

                if ($request->hasFile('image')) {
                    $event->addMultipleMediaFromRequest(['image'])
                        ->each(function ($image) use ($event) {
                            $image->toMediaCollection($event->name);
                        });
                }
//                $event->payment()->create([
//                    '' => $request->total
//                ]);
                $event->save();

                return response()->json([
                    'success'     => 'Event Successfully Created!',
                    'redirect_to' => route('events.index'),
                ]);
            }, $request);
        } catch (\Exception $e) {
            save_error_log($e);
            return response()->json([
                'error' => 'Event Creation Failed!'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function edit(string $event_id)
    {
        $event = Event::findOrFail($event_id);

        return view('backend.events.edit', compact('event'));
    }

    public function update(UpdateEventRequest $request, string $event_id)
    {
        try {
            return $this->wrapInTransaction(function ($event_id, $request) {
                /** @var Event $event */
                $event = Event::findOrFail($event_id);
                $event->fill($request->all());
                if ($request->hasFile('image')) {
                    $event->clearMediaCollection($event->name);
                    $event->addMultipleMediaFromRequest(['image'])
                        ->each(function ($image) use ($event) {
                            $image->toMediaCollection($event->name);
                        });
                }

                if ($request->has('is_published')) {
                    $event->is_published = $request->get('is_published') === 'on';
                }

                if ($request->has('is_registration_allowed')) {
                    $event->is_registration_allowed = $request->get('is_registration_allowed') === 'on';
                }

                $event->save();

                return response()->json([
                    'success'     => 'Event Successfully Updated!',
                    'redirect_to' => route('events.index'),
                ]);
            }, $event_id, $request);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Event Update Request Failed!',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(string $event_id)
    {
        try {
            return $this->wrapInTransaction(function ($event_id) {
                /** @var Event $event */
                $event = Event::findOrFail($event_id);

                $event->delete();

                return redirect()->route('events.index');
            }, $event_id);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Event Delete Request Failed!',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
