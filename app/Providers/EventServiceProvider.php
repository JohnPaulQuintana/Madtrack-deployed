<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Mail\QRCodeEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\AttendanceController;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // parent::boot();

        // // handle sending qrcodes to newly register
        // Event::listen(Registered::class, function ($event) {
        //     $user = $event->user;
        //     // Generate the QR code data using user's name and email
        //     $qrCodeData = json_encode(['name' => $user->name, 'email' => $user->email]);

        //     // Send email with QR code
        //     Mail::to($user->email)->send(new QRCodeEmail($qrCodeData));
        // });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
