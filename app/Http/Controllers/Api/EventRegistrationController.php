<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegistrationRequest;
use App\Http\Requests\UpdateRegistrationRequest;
use App\Http\Resources\RegistrationResource;
use App\Jobs\SendRegistrationSuccessSms;
use App\Models\Event;
use App\Models\Guest;
use App\Models\Payment;
use App\Models\Registration;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EventRegistrationController extends Controller
{
    public function store(string $eventId, StoreRegistrationRequest $request): JsonResponse
    {
        $event = Event::findOrFail($eventId);

        DB::beginTransaction();

        try {
            $registration = $event->registrations()->create([
                'name'           => $request->get('name'),
                'email'          => $request->get('email'),
                'phone'          => $request->get('phone'),
                'batch'          => $request->get('batch', null),
                'cadet_number'   => $request->get('cadet_number', null),
                'address'        => $request->get('address', null),
                'house'          => $request->get('house', null),
                'marital_status' => $request->get('marital_status', null),
                'tshirt_size'    => $request->get('tshirt_size', null)
            ]);

            $invoice = strtoupper(substr($event->name, 0, 3)).'_'.rand(100000, 999999);

            $registration->payment()->create([
                'amount'     => $request->total,
                'quantity'   => $request->quantity,
                'event_id'   => $eventId,
                'invoice_id' => $invoice,
                'status'     => Payment::STATUS_PENDING,
            ]);

            $guests = $request->get('guests', []);

            if (count($guests)) {
                foreach ($guests as $guest) {
                    $registration->guests()->create([
                        'name'     => $guest['name'] ?? null,
                        'age'      => $guest['age'] ?? null,
                        'amount'   => $guest['fee'] ?? null,
                        'quantity' => $guest['quantity'] ?? null,
                        'type'     => $guest['type'] ?? null,
                        'event_id' => $eventId,
                    ]);
                }
            }

//            $user = new User();
//            $user->fill([
//                'first_name' => $request->get('name'),
//                'email'      => $request->get('email'),
//                'phone'      => $request->get('phone'),
//                'password'   => Hash::make(Str::random()),
//                'status'     => UserStatus::ACTIVE,
//                'roles'      => [(string) Role::STUDENT],
//            ]);
//            $user->save();

            DB::commit();

            if ($request->total <= 0) {
                SendRegistrationSuccessSms::dispatch($registration);
            }

            return response()->json(['message' => 'Registration Successful']);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception);

            return response()->json(['message' => 'Registration Failed'], 500);
        }
    }

    public function registration(Request $request): RegistrationResource
    {
        $registration = Registration::with(['event', 'payment', 'guests'])
            ->where('phone', $request->get('phone', null))
            ->firstOrFail();

        return RegistrationResource::make($registration);
    }

    public function update(string $registration_id, UpdateRegistrationRequest $request)
    {
        try {
            return $this->wrapInTransaction(function ($registration_id, $request) {
                /** @var Registration $registration */
                $registration = Registration::findOrFail($registration_id);
                $registration->fill($request->all());
                $registration->save();

                $registration->payment()->update([
                    'amount'   => $request->total,
                    'status'   => $request->payment_status,
                    'quantity' => $request->quantity,
                    'event_id' => $registration->event_id,
                ]);

                $guests = $request->get('guests_update', []);

                if (count($guests)) {
                    foreach ($guests as $guest) {
                        if (array_key_exists('id', $guest)) {
                            Guest::where('id', $guest['id'])->update([
                                'name'     => $guest['name'] ?? null,
                                'age'      => $guest['age'] ?? null,
                                'amount'   => $guest['amount'] ?? null,
                                'quantity' => $guest['quantity'] ?? null,
                                'type'     => array_key_exists('type', $guest)
                                && in_array($guest['type'], [
                                    Registration::TYPE_GUEST_OTHER,
                                    Registration::TYPE_GUEST_SINGLE,
                                    Registration::TYPE_GUEST_COUPLE,
                                    Registration::TYPE_GUEST_DRIVER,
                                    Registration::TYPE_GUEST_MAID,
                                    Registration::TYPE_GUEST_KID_ABOVE,
                                    Registration::TYPE_GUEST_KID_BELOW,
                                ]) ? $guest['type'] : Registration::TYPE_GUEST_OTHER,
                            ]);
                        } else {
                            $registration->guests()->create([
                                'name'     => $guest['name'] ?? null,
                                'age'      => $guest['age'] ?? null,
                                'amount'   => $guest['fee'] ?? null,
                                'quantity' => $guest['quantity'] ?? null,
                                'type'     => $guest['type'] ?? null,
                                'event_id' => $registration->event_id,
                            ]);
                        }
                    }
                }

                return response()->json([
                    'success'     => 'Registration Successfully Updated!',
                    'redirect_to' => route('participants.index'),
                ]);
            }, $registration_id, $request);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Registration Update Request Failed!',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function exist(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string']
        ]);

        $registration = Registration::where('phone', $request->get('phone'))->firstOrFail();

        return view('backend.payment.exist', compact('registration'));
    }
}
