<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Kod QR klienta</title>
</head>
<body>
    <h1>Witaj, {{ $client->email }}</h1>
    <p><strong>ID klienta:</strong> {{ $client->client_code }}</p>
    <p><strong>Punkty startowe:</strong> {{ $client->points_balance }}</p>

    <h3>Twój kod QR:</h3>
    <div>{!! $qr !!}</div>

    <p>Zeskanuj ten kod w firmie, aby zbierać punkty.</p>

    <a href="{{ route('client.register.form') }}">← Powrót do rejestracji</a>
</body>
</html>
