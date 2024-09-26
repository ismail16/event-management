<?php
namespace App\Http\Controllers;
use App\Models\Guest;
use App\Models\Payment;
use App\Models\Event;
use App\Repositories\RegistrationRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Registration;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\RegistrationResource;
use App\Http\Requests\StoreRegistrationRequest;
use App\Http\Requests\UpdateRegistrationRequest;


class EventRegistrationController extends Controller
{
    public function index(Request $request, RegistrationRepository $registrationRepository): Factory|View|Application
    {
        $events        = Event::all();
        $registrations = $registrationRepository->list(Registration::query(), $request);

        return view('backend.participants.index', compact(['registrations', 'events']));
    }

    public function create(): Factory|View|Application
    {
        $events = Event::all();

        return view('backend.participants.create', compact(['events']));
    }

    public function store(string $eventId, StoreRegistrationRequest $request)
    {
        $event = Event::findOrFail($eventId);

        DB::beginTransaction();
        try {
            return $this->wrapInTransaction(function ($eventId, $request, $event) {
                $driver_amount     = 0;
                $maid_amount       = 0;
                $other_amount      = 0;
                $kidBelow_amount   = 0;
                $kidAbove_amount   = 0;
                $driver_quantity   = 0;
                $maid_quantity     = 0;
                $other_quantity    = 0;
                $kidBelow_quantity = 0;
                $kidAbove_quantity = 0;

                $registration = $event
                    ->registrations()
                    ->create([
                        'name'           => $request->get('name'), 'email' => $request->get('email'),
                        'phone'          => $request->get('phone'), 'batch' => $request->get('batch', null),
                        'cadet_number'   => $request->get('cadet_number', null),
                        'address'        => $request->get('address', null),
                        'house'          => $request->get('house', null),
                        'marital_status' => $request->get('marital_status', null),
                        'tshirt_size'    => $request->get('tshirt_size', null)
                    ]);

                if ($request->batch >= 10 && $request->batch <= 53) {
                    $amount          = 1000;
                    $member_quantity = 1;
                } else {
                    $amount          = 0;
                    $member_quantity = 1;
                }

                if ($request->get(Registration::TYPE_GUEST_DRIVER, null)) {
                    $registration->guests()->create([
                        'type'     => Registration::TYPE_GUEST_DRIVER, 'quantity' => $request->driver,
                        'event_id' => $eventId, 'amount' => 500,

                    ]);
                    $driver_amount   = $request->driver * 500;
                    $driver_quantity = $request->driver;
                }
                if ($request->get(Registration::TYPE_GUEST_MAID, null)) {
                    $registration->guests()->create([
                        'type'   => Registration::TYPE_GUEST_MAID, 'quantity' => $request->maid, 'event_id' => $eventId,
                        'amount' => 500,
                    ]);
                    $maid_amount   = $request->maid * 500;
                    $maid_quantity = $request->maid;
                }
                if ($request->get(Registration::TYPE_GUEST_OTHER, null)) {
                    $registration->guests()->create([
                        'type'     => Registration::TYPE_GUEST_OTHER, 'quantity' => $request->other,
                        'event_id' => $eventId, 'amount' => 2500,
                    ]);
                    $other_amount   = $request->other * 2500;
                    $other_quantity = $request->other;
                }
                if ($request->get(Registration::TYPE_GUEST_KID_BELOW, null)) {
                    $registration->guests()->create([
                        'type'     => Registration::TYPE_GUEST_KID_BELOW, 'quantity' => $request->kidBelow,
                        'event_id' => $eventId, 'amount' => 0,
                    ]);
                    $kidBelow_amount   = $request->kidBelow * 0;
                    $kidBelow_quantity = $request->kidBelow;
                }
                if ($request->get(Registration::TYPE_GUEST_KID_ABOVE, null)) {
                    $registration->guests()->create([
                        'type'     => Registration::TYPE_GUEST_KID_BELOW, 'quantity' => $request->kidAbove,
                        'event_id' => $eventId, 'amount' => 1000,
                    ]);
                    $kidAbove_amount   = $request->kidAbove * 1000;
                    $kidAbove_quantity = $request->kidAbove;
                }

                $total    = $amount + $driver_amount + $maid_amount + $other_amount + $kidAbove_amount + $kidBelow_amount;
                $quantity = $member_quantity + $driver_quantity + $maid_quantity + $other_quantity + $kidAbove_quantity + $kidBelow_quantity;
//            $payment->amount   = $newAmount;
//            $payment->quantity = $quantity;
//            $payment->status   = Payment::STATUS_MANUAL;
//            $payment->save();
//            if ($existingAmount > $newAmount) {
//                // refund amount
//                $refundAmount = $existingAmount - $newAmount;
//                $payment->payments_log()->create([
//                    'event_id'        => $registration->event_id,
//                    'registration_id' => $registration_id,
//                    'body'            => "Payment updated with #Status (Manual) and #Refunded amount ({$refundAmount})"
//                ]);
//            } elseif ($existingAmount < $newAmount) {
//                // due
//                $dueAmount = $newAmount - $existingAmount;
//                $payment->payments_log()->create([
//                    'event_id'        => $registration->event_id,
//                    'registration_id' => $registration_id,
//                    'body'            => "Payment updated with #Status (Manual) and #Refunded amount ({$dueAmount})"
//                ]);
//            }


                $event = $registration->event;

                $invoice = strtoupper(substr($event->name, 0, 3)).'_'.rand(100000, 999999);

                $registration->payment()->create([
                    'amount'     => $total,
                    'quantity'   => $quantity,
                    'event_id'   => $eventId,
                    'status'     => $request->get('payment_status'),
                    'invoice_id' => $invoice,
                ]);
                info('???', [$registration->payment()]);

//                $user = new User();
//                $user->fill([
//                    'first_name' => $request->get('name'), 'email' => $request->get('email'),
//                    'phone'      => $request->get('phone'), 'password' => Hash::make(Str::random()),
//                    'status'     => UserStatus::ACTIVE, 'roles' => [(string)Role::STUDENT],
//                ]);
//                $user->save();

                DB::commit();

                return response()->json([
                    'success' => 'Registration Successful!', 'redirect_to' => route('participants.index'),
                ]);
            }, $eventId, $request, $event);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            return response()->json([
                'error' => 'Registration Delete Request Failed!',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function registration(Request $request): RegistrationResource
    {
        $registration = Registration::with(['event', 'payment', 'guests'])->where('phone',
            $request->get('phone', null))->firstOrFail();

        return RegistrationResource::make($registration);
    }

    public function edit(string $registration_id)
    {
        $registration = Registration::with(['payment'])->findOrFail($registration_id);
        $event        = $registration->event;
        $guests       = $registration->guests;


        return view('backend.participants.edit', compact(['registration', 'event', 'guests']));
    }

    public function update(string $registration_id, UpdateRegistrationRequest $request)
    {
        info('&&&', [$registration_id, $request->all()]);
        try {
            return $this->wrapInTransaction(function ($registration_id, $request) {
                $amount          = 0;
                $driver_amount   = 0;
                $maid_amount     = 0;
                $guest_amount    = 0;
                $kidBelow_amount = 0;
                $kidAbove_amount = 0;
                $driver          = 0;
                $maid            = 0;
                $other           = 0;
                $kidBelow        = 0;
                $kidAbove        = 0;

                $registration = Registration::findOrFail($registration_id);
                $guests       = $registration->guests;

                if ($request->batch >= 10 && $request->batch <= 53) {
                    $amount          = 1000;
                    $member_quantity = 1;
                } else {
                    $amount = 0 ;
                    $member_quantity = 1;
                }

                foreach ($guests as $guest) {
                    if ($guest->type == Registration::TYPE_GUEST_DRIVER) {
                        $driver_id     = $guest->id;
                        $driver        = $request->driver;
                        $driver_amount = $guest->amount * $driver;

                        Guest::where('type', Registration::TYPE_GUEST_DRIVER)->where('registration_id',
                            $registration_id)->where('event_id', $registration->event_id)->update([
                            'quantity' => $driver,
                        ]);
                    } elseif ($guest->type == Registration::TYPE_GUEST_MAID) {
                        $maid_id     = $guest->id;
                        $maid        = $request->maid;
                        $maid_amount = $guest->amount * $maid;
                        Guest::where('type', Registration::TYPE_GUEST_MAID)->where('registration_id',
                            $registration_id)->where('event_id', $registration->event_id)->update([
                            'quantity' => $maid,
                        ]);
                    } elseif ($guest->type == Registration::TYPE_GUEST_OTHER) {
                        $guest_id     = $guest->id;
                        $other        = $request->other;
                        $guest_amount = $guest->amount * $other;
                        Guest::where('type', Registration::TYPE_GUEST_OTHER)->where('registration_id',
                            $registration_id)->where('event_id', $registration->event_id)->update([
                            'quantity' => $other,
                        ]);
                    } elseif ($guest->type == Registration::TYPE_GUEST_KID_BELOW) {
                        $kidBelow_id     = $guest->id;
                        $kidBelow        = $request->kidBelow;
                        $kidBelow_amount = $guest->amount * $kidBelow;
                        Guest::where('type', Registration::TYPE_GUEST_KID_BELOW)->where('registration_id',
                            $registration_id)->where('event_id', $registration->event_id)->update([
                            'quantity' => $kidBelow,
                        ]);
                    } elseif ($guest->type == Registration::TYPE_GUEST_KID_ABOVE) {
                        $kidAbove_id     = $guest->id;
                        $kidAbove        = $request->kidAbove;
                        $kidAbove_amount = $guest->amount * $kidAbove;
                        Guest::where('type', Registration::TYPE_GUEST_KID_ABOVE)->where('registration_id',
                            $registration_id)->where('event_id', $registration->event_id)->update([
                            'quantity' => $kidAbove,
                        ]);
                    }
                }

                $payment = $registration->payment;

                $existingAmount = $payment->amount;
                $newAmount      = $amount + $driver_amount + $maid_amount + $guest_amount + $kidAbove_amount + $kidBelow_amount;
                $quantity       = $member_quantity + $driver + $maid + $other + $kidAbove + $kidBelow;

                $payment->amount   = $newAmount;
                $payment->quantity = $quantity;
                $payment->status   = $request->get('payment_status');              //Payment::STATUS_MANUAL;
                $payment->save();
                if ($existingAmount > $newAmount) {
                    // refund amount
                    $refundAmount = $existingAmount - $newAmount;
                    $payment->payments_log()->create([
                        'event_id' => $registration->event_id, 'registration_id' => $registration_id,
                        'body'     => "Payment updated with #Status (Manual) and #Refunded amount ({$refundAmount})"
                    ]);
                } elseif ($existingAmount < $newAmount) {
                    // due
                    $dueAmount = $newAmount - $existingAmount;
                    $payment->payments_log()->create([
                        'event_id' => $registration->event_id, 'registration_id' => $registration_id,
                        'body'     => "Payment updated with #Status (Manual) and #Refunded amount ({$dueAmount})"
                    ]);
                }

                Registration::where('id', $registration_id)->update([
                    'house' => $request->house,
                ]);

                return response()->json([
                    'success'     => 'Registration Successfully Updated!',
                    'redirect_to' => route('participants.index'),
                ]);
            }, $registration_id, $request);
        } catch (\Exception $e) {
            Log::error($e);

            return response()->json([
                'error' => 'Registration Update Request Failed!',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(string $registration_id)
    {
        try {
            return $this->wrapInTransaction(function ($registration_id) {
                /** @var Registration $registration */
                $registration = Registration::findOrFail($registration_id);
                $registration->delete();

                return response()->json([
                    'success'     => 'Registration deleted successfully',
                    'redirect_to' => route('participants.index')
                ]);
            }, $registration_id);
        } catch (\Exception $e) {
            save_error_log($e);
            return response()->json([
                'error' => 'Registration Delete Request Failed!',
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
