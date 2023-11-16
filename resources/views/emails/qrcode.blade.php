<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #f4f4f4;
            padding: 10px;
            text-align: center;
        }

        .content {
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .qr-code {
            display: block;
            margin: 20px auto;
        }

        .download-link {
            display: block;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>QRCODE ATTENDANCE</h1>
        </div>
        <div class="content">
            <p>Dear {{ $name }},</p>
            <p>Thank you for verifying your email. Below is your QR code for verification:</p>
            <img src="{{ $message->embedData($qrCode, $email.'.png') }}" alt="QR Code" class="qr-code">
            <p>To download the QR code, click the link below:</p>
            <!-- Provide a link to the attached QR code -->
            <a href="cid:{{ $email }}.png" class="download-link" download="{{ $email }}.png">Download QR Code Below</a>
            {{-- <a href="data:image/png;base64,{{ base64_encode($qrCode) }}" download="{{ $email }}.png" class="download-link">Download QR Code</a> --}}
            <p>Use the QR code for attendance purposes only.</p>
            {{-- <p>Click the link below to access attendance page.</p>
            <a href="{{ route('scan.attendance') }}" class="download-link">Download QR Code Below</a> --}}
            <p>If you have any questions or need assistance, please contact our support team.</p>
            <p>Best regards,<br>Your Application Team</p>
        </div>
    </div>
</body>
</html>
