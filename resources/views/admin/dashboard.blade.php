@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-dark text-white text-center">
                    <h3>Panel Administratora</h3>
                </div>
                <div class="card-body text-center">

                    <img src="http://top-price.com.pl/wp-content/uploads/2024/10/logo-1.png"
                         alt="Logo" class="mb-4" style="max-width: 200px;">

                    <h5>Witaj w panelu admina!</h5>
                    <p>Wybierz jedną z opcji poniżej:</p>

                    <div class="d-grid gap-3 mt-4">
                        <a href="{{ route('admin.register') }}" class="btn btn-success btn-lg">
                            ➕ Rejestruj firmę
                        </a>
                        <a href="#" class="btn btn-primary btn-lg">
                            📊 Statystyki
                        </a>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-lg">
                                🚪 Wyloguj
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
