<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome Employee</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <!-- Include your custom CSS here if needed -->
    <style>
         .center-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container mt-3 center-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card text-center p-4" style="box-shadow: rgba(58, 25, 207, 0.35) 0px 5px 15px;">
                    <div class="card-body">
                        <h1 class="card-title">Congratulations!</h1>
                        <h4 class="" style="color: rgb(58, 25, 207);">{{ $verificationData['email']}}</h4>
                        <p class="card-text">You are now a registered employee.</p>
                        <img src="{{ asset('logo/logo.png') }}" width="150px" alt="Success Image" class="img-fluid mt-4 border rounded">
                        <p style="color: rgb(58, 25, 207);"><b>B.I.S logo</b></p>
                        <p class="mt-3">The <span style="color: rgb(58, 25, 207);"><b>QR code</b></span> for attendance has been sent to your <span style="color: rgb(58, 25, 207);"><b>email</b></span>.</p>
                        {{-- <a href="{{ route() }}" class="btn btn-primary mt-4">Get Started</a> --}}
                        <p class="text-secondary mt-3">B.I.S - version 1.2.0 create by - Allen Dale Pangilinan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Include Bootstrap JS (optional, if you need any Bootstrap JavaScript features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include your custom scripts here if needed -->
</body>
</html>
