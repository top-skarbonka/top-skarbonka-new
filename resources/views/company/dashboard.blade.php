<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel firmy</title>
</head>
<body>
    <h1>Witaj w panelu firmy!</h1>

    <p>
        <a href="{{ route('company.points.create') }}">➕ Przyznaj punkty klientowi</a>
    </p>

    <form method="POST" action="{{ route('company.logout') }}">
        @csrf
        <button type="submit">Wyloguj</button>
    </form>
</body>
</html>
