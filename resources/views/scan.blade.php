<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scanner</title>
</head>

<body>
    {{-- <div id="scanner-container"></div> --}}

    <!-- Form to upload QR code -->
    {{-- <form method="POST" action="{{ route('upload-qr') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="qr_code_image" accept="image/*">
        <button type="submit">Upload QR Code</button>
    </form>

    <div>
        {!! $qrCode !!} <!-- Display the generated QR code -->
    </div> --}}

    <div id="reader" width="50" height="50"></div>
    <div id="result-container">dwadwadwa</div>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
</body>

</html>
