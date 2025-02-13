<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <p>this code dont give to anybody becouse, this code to verify your email:</p>
    <code>{{ $token }}</code>
    {{-- <a href="{{ env('FRONTEND_URL') }}/verify-email?token={{ $token }}">Verify Email</a> --}}
</body>
</html>
