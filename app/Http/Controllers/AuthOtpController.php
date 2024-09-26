<?php

namespace App\Http\Controllers;

use App\Http\Resources\RegistrationResource;
use App\Models\Registration;
use App\Models\User;
use App\Models\VerificationCode;
use App\Sms\Facades\SMS;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthOtpController extends Controller
{
    public function exist(Request $request): RegistrationResource
    {
        $phone            = $request->get('phone', null);
        $eventId            = $request->get('event_id', null);
       // $registration     = Registration::where('phone', $phone)->firstOrFail();
        $registration = Registration::where('phone', $phone)
            ->where('event_id', $eventId)
            ->firstOrFail();
      //  info('', [$registration]);
        $verificationCode = $this->generateOtp($phone);
        $message          = "Your OTP To Login is - ".$verificationCode->otp;

        SMS::send($phone, $message);

        return RegistrationResource::make($registration);
    }

    public function getExistingRegistration(Request $request): JsonResponse
    {
        $phone = $request->get('phone', null);
        $token = $request->get('token', null);

        $userToken = \Laravel\Sanctum\PersonalAccessToken::findToken($token);
        $user      = $userToken?->tokenable;

        if (!$user) {
            return response()->json([
                'message' => 'Invalid token'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $registration = Registration::with(['event', 'payment', 'guests'])
            ->where('phone', $phone)->firstOrFail();

        return response()->json([
            'registration' => RegistrationResource::make($registration)
        ]);
    }



    public function generate(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:users,phone',
        ]);

        $phone = $request->phone;

        $verificationCode = $this->generateOtp($phone);
        $message          = "Your OTP To Login is - ".$verificationCode->otp;

        SMS::send($phone, $message);
    }

    public function generateOtp($phone)
    {
        $user = User::where('phone', $phone)->firstOrFail();

        return $user->verificationCodes()->create([
            'otp'       => rand(123456, 999999),
            'expire_at' => Carbon::now()->addMinutes(5)
        ]);
    }

    public function verification($user_id): Factory|View|Application
    {
        return view('auth.otp-verification')->with([
            'user_id' => $user_id
        ]);
    }

    public function loginOtp(Request $request): Redirector|RedirectResponse|Application
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'otp'     => 'required'
        ]);

        $verificationCode = VerificationCode::where('user_id', $request->user_id)
            ->where('otp', $request->otp)
            ->first();

        if (!$verificationCode) {
            return redirect()->back()->with('error', 'Your OTP is not correct');
        } else {
            if (now()->isAfter($verificationCode->expire_at)) {
                return redirect()->route('otp.login')->with('error', 'Your OTP has been expired');
            }
        }
        $user = User::whereId($request->user_id)->first();

        if ($user) {
            $verificationCode->update([
                'expire_at' => Carbon::now()
            ]);
            Auth::login($user);
            return redirect('/dashboard');
        }
        return redirect()->route('otp.login')->with('error', 'Your Otp is not correct');
    }

    public function check(Request $request): Factory|View|Application
    {
        $request->validate([
            'phone' => ['required', 'string'],
        ]);

        $phone = $request->get('phone');

        return view('otp.otp_check', compact('phone'));
    }

    public function verify(Request $request): Factory|View|Application|RedirectResponse
    {
        $request->validate([
            'phone' => ['required', 'string'],
        ]);
        $phone = $request->get('phone');
        $code  = $request->get('otp');

        $user = User::where('phone', $phone)
            ->firstOrFail();

        $isVerified = $user
            ->verificationCodes()
            ->where('otp', $code)
            ->where('expire_at', '>', now())
            ->first();

        if (!$isVerified) {
            return redirect()->back()->with('error', 'Your OTP is invalid or expired');
        } else {
            return view('otp.password_send', compact('phone', 'code'));
        }
    }
}
