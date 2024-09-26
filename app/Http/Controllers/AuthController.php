<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use App\Enums\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        if (!Auth::user()) {
            return view('backend.auth.login');
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string'
        ]);

        $user = User::where('email', $request->get('email'))->where('status', UserStatus::ACTIVE)->first();

        if (!$user) {
            return redirect()->back()->with(['_status' => 'fails', '_msg' => 'No user found for this credentials']);
        }

        if (!Auth::attempt(['email' => $request->get('email'), 'password' => $request->input('password')], true)) {
            return redirect()->back()->with(['_status' => 'fails', '_msg' => 'Wrong credentials, please try again!']);
        }

        if (!Auth::check()) {
            return redirect()->back()->with([
                '_status' => 'fails', '_msg' => 'Something went wrong, please try again!'
            ]);
        }

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('auth.login.page');
    }


    public function passwordReset(Request $request)
    {
        info('', [$request->all()]);

        $request->validate([
            'phone' => ['required', 'string'],
            'code'  => ['required', 'string'],
            'new_password' => ['required', 'string'],
            'confirm_password' => ['required', 'string'],
        ]);

        $phone = $request->get('phone');
        $code  = $request->get('code');

        /** @var User $user */
        $user = User::where('phone', $phone)
            ->firstOrFail();

        $isVerified = $user
            ->verificationCodes()
            ->where('otp', $code)
//            ->where('expire_at', '>', now())
            ->first();

        if (!$isVerified) {
            info('done$$$$$$', [$code, $user->verificationCodes]);

            return view('otp.otp_send', ['phone' => $phone])->with('error', 'Your OTP is invalid or expired');
        } else {
            //            info('done$$$$$$', [$user]);

            $user->update([
                'password' => Hash::make($request->get('password'))
            ]);



            $token = $user->createToken('login');
            $registrationData = Registration::with(['event', 'payment', 'guests'])
                ->where('phone', $request->get('phone', null))
                ->firstOrFail();
            ;
            $event_id = $registrationData->event->id;
            return redirect("http://localhost:5173/event/${event_id}/register")->with(['phone' => $phone, 'event' => $registrationData]);

            return response()->json([
                'access_token' => $token->plainTextToken
            ]);
        }
    }
}
