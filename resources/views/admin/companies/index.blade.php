@extends('admin.layout')

@section('title','Lista firm')

@section('content')
    <h2 class="mb-3 text-center">Lista zarejestrowanych firm</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Wyszukiwarka -->
    <form method="GET" action="{{ route('admin.companies.index') }}" class="row g-2 mb-3">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Szukaj po ID lub telefonie" class="form-control">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Szukaj</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('admin.companies.index') }}" class="btn btn-secondary w-100">Reset</a>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.companies.create') }}" class="btn btn-success">➕ Dodaj firmę</a>
        </div>
    </form>

    <div class="card shadow-sm p-4">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nazwa</th>
                    <th>Email</th>
                    <th>NIP</th>
                    <th>Telefon</th>
                    <th>Miasto</th>
                    <th>Status</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @forelse($companies as $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>{{ $company->nip }}</td>
                        <td>{{ $company->phone }}</td>
                        <td>{{ $company->city }}</td>
                        <td>
                            @if($company->is_active)
                                <span class="badge bg-success">Aktywna</span>
                            @else
                                <span class="badge bg-danger">Zawieszona</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.companies.show', $company->id) }}" class="btn btn-sm btn-primary">Szczegóły</a>
                            <a href="{{ route('admin.companies.edit', $company->id) }}" class="btn btn-sm btn-warning">Edytuj</a>

                            <form method="POST" action="{{ route('admin.companies.resetPassword', $company->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-info">Reset hasła</button>
                            </form>

                            <form method="POST" action="{{ route('admin.companies.toggleStatus', $company->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-secondary">
                                    {{ $company->is_active ? 'Zawieś' : 'Aktywuj' }}
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.companies.destroy', $company->id) }}" class="d-inline" onsubmit="return confirm('Na pewno usunąć firmę?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Usuń</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Brak zarejestrowanych firm</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
