<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SearchRequest;
use App\Models\Event;
use App\Repositories\ApiEventRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class EventController extends Controller
{
    public function index(Request $request, ApiEventRepository $eventRepository): AnonymousResourceCollection
    {
        // filter - > upcoming, ongoing, latest
        $events = $eventRepository->getEvents(Event::query(), $request);

        return EventResource::collection($events);
    }

    public function event(string $eventId): EventResource
    {
        /** @var Event $event */
        $event = Event::findOrFail($eventId);

        return new EventResource($event);
    }

    public function search(SearchRequest $request, ApiEventRepository $repository): AnonymousResourceCollection
    {
        /** @var Event $events */
        $events = $repository->search(Event::query(), $request);

        return EventResource::collection($events);
    }
}
