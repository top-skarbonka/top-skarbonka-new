<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Przyznaj punkty</title>
</head>
<body>
    <h1>Przyznaj punkty klientowi</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('company.points.store') }}">
        @csrf

        <div>
            <label>ID klienta:</label><br>
            <input type="text" name="client_id" value="{{ $clientId ?? '' }}" readonly>
        </div>

        <div>
            <label>Numer paragonu/FV:</label><br>
            <input type="text" name="receipt_number" required>
        </div>

        <div>
            <label>Kwota (PLN):</label><br>
            <input type="number" step="0.01" name="amount" required>
        </div>

        <br>
        <button type="submit">Dodaj punkty</button>
    </form>
</body>
</html>
