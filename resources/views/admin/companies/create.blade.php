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

            <!-- Nazwa firmy -->
            <div class="mb-3">
                <label class="form-label">Nazwa firmy</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
            </div>

            <!-- Kod pocztowy -->
            <div class="mb-3">
                <label class="form-label">Kod pocztowy</label>
                <input type="text" name="postal_code" value="{{ old('postal_code') }}" class="form-control" required>
            </div>

            <!-- Miasto -->
            <div class="mb-3">
                <label class="form-label">Miasto</label>
                <input type="text" name="city" value="{{ old('city') }}" class="form-control" required>
            </div>

            <!-- Ulica -->
            <div class="mb-3">
                <label class="form-label">Ulica</label>
                <input type="text" name="street" value="{{ old('street') }}" class="form-control" required>
            </div>

            <!-- NIP -->
            <div class="mb-3">
                <label class="form-label">NIP</label>
                <input type="text" name="nip" value="{{ old('nip') }}" class="form-control" required>
            </div>

            <!-- Telefon -->
            <div class="mb-3">
                <label class="form-label">Numer telefonu</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Adres e-mail (login)</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
            </div>

            <!-- Przelicznik -->
            <div class="mb-3">
                <label class="form-label">Przelicznik (1 zł = ile punktów)</label>
                <input type="number" step="0.01" min="0" name="exchange_rate" value="{{ old('exchange_rate', 0.5) }}" class="form-control" required>
            </div>

            <!-- Umowa -->
            <div class="mb-3">
                <label class="form-label">Podpisana umowa (skan/zdjęcie)</label>
                <input type="file" name="agreement_file" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
            </div>

            <!-- Regulamin -->
            <div class="mb-3">
                <label class="form-label">Regulamin (skan/zdjęcie)</label>
                <input type="file" name="regulations_file" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success">Zarejestruj firmę</button>
            </div>
        </form>
    </div>
@endsection
