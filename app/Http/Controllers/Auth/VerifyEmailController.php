<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Mail\QRCodeEmail;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user(); // Get the authenticated user
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
            // Generate the QR code data using user's name and email
            $qrCodeData = json_encode(['name' => $user->name, 'email' => $user->email]);

            // Send email with QR code
            Mail::to($user->email)->send(new QRCodeEmail($qrCodeData));
        }
        // Inside your verification logic
        Session::put('verification_data', [
            'name' => $user->name,
            'email' => $user->email,
            'time' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
         // Log out the user
        Auth::logout();
        // original
        // return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        return redirect()->route('verification.success');
    }
}
