<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Administratora - Logowanie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
        }
        .login-card {
            width: 480px;
            border-radius: 12px;
        }
        .form-label {
            font-weight: 600;
        }
        .password-toggle {
            cursor: pointer;
        }
        .logos img {
            max-height: 150px;
        }
        .contact-info {
            font-size: 0.85rem;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow-lg p-4 login-card">
        <div class="text-center mb-4">
            <div class="d-flex justify-content-center align-items-center mb-3 logos">
                <img src="http://top-price.com.pl/wp-content/uploads/2024/10/logo-1.png" 
                     alt="Top Price" style="margin-right: 15px;">
                <img src="http://top-price.com.pl/wp-content/uploads/2025/09/top-skarbonka.png" 
                     alt="Top Skarbonka">
            </div>
            <p class="text-muted contact-info mb-3">
                📞 732-287-103 <br>
                ✉️ kontakt@top-price.com.pl
            </p>
            <h3 class="fw-bold">Panel Administratora</h3>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3 position-relative">
                <label class="form-label">Hasło</label>
                <div class="input-group">
                    <input type="password" name="password" id="admin-password" class="form-control" required>
                    <span class="input-group-text password-toggle" onclick="togglePassword('admin-password')">
                        👁️
                    </span>
                </div>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="remember" class="form-check-input" id="remember-admin">
                <label class="form-check-label" for="remember-admin">Zapamiętaj mnie</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Zaloguj się</button>
        </form>
    </div>

    <script>
        function togglePassword(id) {
            const pass = document.getElementById(id);
            pass.type = pass.type === 'password' ? 'text' : 'password';
        }
    </script>

</body>
</html>
