<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja klienta</title>
</head>
<body>
    <h1>Zarejestruj się w programie lojalnościowym</h1>

    {{-- Sekcja błędów --}}
    @if ($errors->any())
        <div style="color:red; margin-bottom:15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formularz rejestracji --}}
    <form method="POST" action="{{ route('client.register.submit') }}">
        @csrf

        <div style="margin-bottom:10px;">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div style="margin-bottom:10px;">
            <label for="postal_code">Kod pocztowy:</label><br>
            <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code') }}" required>
        </div>

        <div style="margin-bottom:10px;">
            <label for="city">Miasto:</label><br>
            <input type="text" id="city" name="city" value="{{ old('city') }}" required>
        </div>

        <div style="margin-bottom:10px;">
            <label for="phone">Telefon (opcjonalnie):</label><br>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}">
        </div>

        <div style="margin-top:12px;">
            <button type="submit">Zarejestruj</button>
        </div>
    </form>
</body>
</html>
