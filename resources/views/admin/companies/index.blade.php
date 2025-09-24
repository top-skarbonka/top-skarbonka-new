@extends('admin.layout')

@section('title','Firmy')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Firmy</h2>
        <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">➕ Dodaj firmę</a>
    </div>

    <!-- 🔍 Wyszukiwarka -->
    <form method="GET" action="{{ route('admin.companies.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Szukaj po ID lub telefonie">
            <button class="btn btn-outline-secondary" type="submit">Szukaj</button>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Kod</th>
                        <th>Nazwa</th>
                        <th>Email</th>
                        <th>Telefon</th>
                        <th>Kurs pkt</th>
                        <th>Aktywna</th>
                        <th>Dodano</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $c)
                        <tr>
                            <td>{{ $c->id }}</td>
                            <td><span class="badge bg-secondary">{{ $c->company_code }}</span></td>
                            <td>{{ $c->name }}</td>
                            <td>{{ $c->email }}</td>
                            <td>{{ $c->phone ?? '-' }}</td>
                            <td>{{ number_format($c->points_rate,2) }}</td>
                            <td>
                                @if($c->is_active)
                                    <span class="badge bg-success">TAK</span>
                                @else
                                    <span class="badge bg-danger">NIE</span>
                                @endif
                            </td>
                            <td>{{ $c->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('admin.companies.edit', $c->id) }}" class="btn btn-sm btn-warning">✏️ Edytuj</a>
                                <form action="{{ route('admin.companies.resetPassword', $c->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-info">🔑 Reset hasła</button>
                                </form>
                                <form action="{{ route('admin.companies.toggle', $c->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-secondary">
                                        {{ $c->is_active ? '⏸️ Zawieś' : '▶️ Aktywuj' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.companies.destroy', $c->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Na pewno usunąć tę firmę?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">🗑️ Usuń</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">Brak firm w bazie.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $companies->links() }}
    </div>
@endsection
