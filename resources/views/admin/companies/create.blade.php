@extends('admin.layout')

@section('title','Rejestracja firmy')

@section('content')
    <h2 class="mb-3 text-center">Rejestracja firmy</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm p-4">
        <form method="POST" action="{{ route('admin.companies.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Nazwa firmy (opcjonalna) -->
            <div class="mb-3">
                <label class="form-label">Nazwa firmy</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
            </div>

            <!-- Kod pocztowy (opcjonalny) -->
            <div class="mb-3">
                <label class="form-label">Kod pocztowy</label>
                <input type="text" name="postal_code" value="{{ old('postal_code') }}" class="form-control">
            </div>

            <!-- Miasto (opcjonalne) -->
            <div class="mb-3">
                <label class="form-label">Miasto</label>
                <input type="text" name="city" value="{{ old('city') }}" class="form-control">
            </div>

            <!-- Ulica (opcjonalna) -->
            <div class="mb-3">
                <label class="form-label">Ulica</label>
                <input type="text" name="street" value="{{ old('street') }}" class="form-control">
            </div>

            <!-- NIP (opcjonalny) -->
            <div class="mb-3">
                <label class="form-label">NIP</label>
                <input type="text" name="nip" value="{{ old('nip') }}" class="form-control">
            </div>

            <!-- Telefon (opcjonalny) -->
            <div class="mb-3">
                <label class="form-label">Telefon</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
            </div>

            <!-- Email (wymagany) -->
            <div class="mb-3">
                <label class="form-label">Adres e-mail (login)</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
            </div>

            <!-- Przelicznik punktów (wymagany) -->
            <div class="mb-3">
                <label class="form-label">Przelicznik: 1 zł = ile punktów</label>
                <input type="number" step="0.01" min="0" name="points_rate" value="{{ old('points_rate', 0.5) }}" class="form-control" required>
            </div>

            <!-- Umowa (opcjonalna) -->
            <div class="mb-3">
                <label class="form-label">Podpisana umowa (zdjęcie/PDF)</label>
                <input type="file" name="agreement_file" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
            </div>

            <!-- Regulamin (opcjonalny) -->
            <div class="mb-3">
                <label class="form-label">Podpisany regulamin (zdjęcie/PDF)</label>
                <input type="file" name="regulations_file" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
            </div>

            <button type="submit" class="btn btn-success w-100">✅ Zarejestruj firmę</button>
        </form>
    </div>
@endsection
