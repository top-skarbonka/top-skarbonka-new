@extends('admin.layout')

@section('title','Edycja firmy')

@section('content')
    <h2 class="mb-3 text-center">Edycja firmy</h2>

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
        <form method="POST" action="{{ route('admin.companies.update', $company) }}" enctype="multipart/form-data">
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
                <label class="form-label">Adres e-mail (login)</label>
                <input type="email" name="email" value="{{ old('email',$company->email) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Przelicznik (1 zł = ile punktów)</label>
                <input type="number" step="0.01" min="0.01" name="points_rate" value="{{ old('points_rate',$company->points_rate) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Podpisana umowa (jpg, png, pdf)</label><br>
                @if($company->agreement_file)
                    <a href="{{ asset('storage/'.$company->agreement_file) }}" target="_blank" class="btn btn-sm btn-outline-primary mb-2">📄 Zobacz plik</a>
                @endif
                <input type="file" name="agreement_file" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Regulamin (jpg, png, pdf)</label><br>
                @if($company->rules_file)
                    <a href="{{ asset('storage/'.$company->rules_file) }}" target="_blank" class="btn btn-sm btn-outline-primary mb-2">📄 Zobacz plik</a>
                @endif
                <input type="file" name="rules_file" class="form-control">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">💾 Zapisz zmiany</button>
                <a href="{{ route('admin.companies.index') }}" class="btn btn-secondary">⬅️ Powrót</a>
            </div>
        </form>
    </div>
@endsection
