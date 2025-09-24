<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Przyznaj punkty</title>
</head>
<body>
    <h1>Przyznaj punkty klientowi</h1>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

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
            <label>ID klienta (UUID):</label>
            <input type="text" name="client_id" value="{{ old('client_id') }}" required>
        </div>

        <div>
            <label>Numer paragonu/FV:</label>
            <input type="text" name="receipt_number" value="{{ old('receipt_number') }}" required>
        </div>

        <div>
            <label>Kwota (PLN):</label>
            <input type="number" step="0.01" min="0.01" name="amount_pln" value="{{ old('amount_pln') }}" required>
        </div>

        <div style="margin-top:12px;">
            <button type="submit">Przyznaj punkty</button>
        </div>
    </form>

    <p style="margin-top:20px;">
        <a href="{{ route('company.dashboard') }}">← Powrót do panelu firmy</a>
    </p>
</body>
</html>
