<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admina - Logowanie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .logo {
            height: 120px; /* większe logo, takie jak w panelu firmy */
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="text-center w-100" style="max-width: 400px;">
        <!-- Logo -->
        <div class="mb-4">
            <img src="http://top-price.com.pl/wp-content/uploads/2024/10/logo-1.png" alt="Logo" class="logo">
            <h2 class="mt-3">Panel Admina</h2>
        </div>

        <!-- Formularz logowania -->
        <div class="card shadow p-4 text-start">
            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Adres e-mail</label>
                    <input type="email" name="email" class="form-control" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Hasło</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Zaloguj się</button>
            </form>
        </div>
    </div>
</body>
</html>
