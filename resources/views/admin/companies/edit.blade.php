@extends('admin.layout')

@section('title','Edytuj firmę')

@section('content')
    <h2 class="mb-3 text-center">Edytuj firmę</h2>

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
        <form method="POST" action="{{ route('admin.companies.update',$company->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nazwa firmy</label>
                <input type="text" name="name" value="{{ old('name',$company->name) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kod pocztowy</label>
                <input type="text" name="postal_code" value="{{ old('postal_code',$company->postal_code) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Miasto</label>
                <input type="text" name="city" value="{{ old('city',$company->city) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">NIP</label>
                <input type="text" name="nip" value="{{ old('nip',$company->nip) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Telefon</label>
                <input type="text" name="phone" value="{{ old('phone',$company->phone) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Email (login)</label>
                <input type="email" name="email" value="{{ old('email',$company->email) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kurs punktowy (pkt za 1 zł)</label>
                <input type="number" step="0.01" min="0" name="points_rate" value="{{ old('points_rate',$company->points_rate) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Nowe hasło (opcjonalnie)</label>
                <input type="password" name="password" class="form-control">
                <small class="text-muted">Zostaw puste, aby nie zmieniać hasła</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Umowa (plik)</label>
                <input type="file" name="agreement_file" class="form-control">
                @if($company->agreement_file)
                    <a href="{{ asset('storage/'.$company->agreement_file) }}" target="_blank">📂 Zobacz aktualny plik</a>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Regulamin (plik)</label>
                <input type="file" name="rules_file" class="form-control">
                @if($company->rules_file)
                    <a href="{{ asset('storage/'.$company->rules_file) }}" target="_blank">📂 Zobacz aktualny plik</a>
                @endif
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" class="form-check-input" {{ $company->is_active ? 'checked' : '' }}>
                <label class="form-check-label">Firma aktywna</label>
            </div>

            <button type="submit" class="btn btn-success w-100">💾 Zapisz zmiany</button>
        </form>
    </div>
@endsection
