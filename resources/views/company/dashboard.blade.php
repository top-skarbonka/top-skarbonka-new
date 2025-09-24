<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Firmy</title>
</head>
<body>
    <h2>Witaj w panelu firmy!</h2>

    <form method="POST" action="{{ route('company.logout') }}">
        @csrf
        <button type="submit">Wyloguj</button>
    </form>
</body>
</html>
