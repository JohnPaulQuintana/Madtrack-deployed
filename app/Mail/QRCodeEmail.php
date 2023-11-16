<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $qrCodeData;
    public $email;
    public $name;

    public $qrCode;
    /**
     * Create a new message instance.
     */
    public function __construct($qrCodeData)
    {
        $this->qrCodeData = $qrCodeData;
        // $this->email = $email;
    }


     /**
     * Build the message.
     */
    public function build()
    {
        $role = 'Employee';     // Replace with actual role
            // Format the QR code data with full name, role, and time-in
       $data = json_decode($this->qrCodeData);
       $this->name = $data->name; 
    //    dd($data);
       $qrCodeDataGenerate = "Name: $data->name, Email: $data->email, Role: $role, Time-in: " . Carbon::now()->format('Y-m-d H:i:s');

        $this->qrCode = (string)QrCode::format('png')
        // ->mergeString(public_path('logo/logo.png'))
        ->size(250)
        ->backgroundColor(255, 255, 255)
        ->color(0, 0, 0)   
        ->generate($qrCodeDataGenerate);

        return $this->view('emails.qrcode')
            ->attachData($this->qrCode, $data->email.'.png', ['mime' => 'image/png']);
    }

}
