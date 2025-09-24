<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','Panel Administratora')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f8f9fa; }
        .logos img { max-height: 90px; }
        .sidebar { min-height: 100vh; background: #ffffff; border-right: 1px solid #eee; }
        .sidebar .nav-link { color: #333; font-weight: 600; }
        .sidebar .nav-link.active { background: #0d6efd; color: #fff; }
        .content { padding: 24px; }
        .small-muted { font-size: .85rem; color: #6c757d; }
    </style>
</head>
<body>

<nav class="navbar bg-white border-bottom">
    <div class="container-fluid py-2">
        <div class="d-flex align-items-center">
            <div class="d-flex align-items-center logos">
                <img src="http://top-price.com.pl/wp-content/uploads/2024/10/logo-1.png" class="me-2" alt="Top Price">
                <img src="http://top-price.com.pl/wp-content/uploads/2025/09/top-skarbonka.png" alt="Top Skarbonka">
            </div>
        </div>
        <div class="text-end small-muted">
            📞 732-287-103 &nbsp; | &nbsp; ✉️ kontakt@top-price.com.pl
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <aside class="col-12 col-md-3 col-xl-2 sidebar p-3">
            <div class="nav flex-column nav-pills">
                <a class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
                <a class="nav-link @if(request()->routeIs('admin.companies.*')) active @endif" href="{{ route('admin.companies.index') }}">🏢 Firmy</a>
                <a class="nav-link disabled">👥 Klienci (wkrótce)</a>
                <a class="nav-link disabled">🧾 Transakcje (wkrótce)</a>
                <form method="POST" action="{{ route('admin.logout') }}" class="mt-3">
                    @csrf
                    <button class="btn btn-outline-danger w-100">🚪 Wyloguj</button>
                </form>
            </div>
        </aside>
        <main class="col-12 col-md-9 col-xl-10 content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
