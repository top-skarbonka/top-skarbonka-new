@extends('admin.layout')

@section('title','Szczegóły firmy')

@section('content')
    <h2 class="mb-3">Szczegóły firmy</h2>

    <div class="card shadow-sm p-4">
        <table class="table table-bordered">
            <tr>
                <th>ID firmy</th>
                <td>{{ $company->company_id }}</td>
            </tr>
            <tr>
                <th>Nazwa</th>
                <td>{{ $company->name }}</td>
            </tr>
            <tr>
                <th>Kod pocztowy</th>
                <td>{{ $company->postal_code }}</td>
            </tr>
            <tr>
                <th>Miasto</th>
                <td>{{ $company->city }}</td>
            </tr>
            <tr>
                <th>Ulica</th>
                <td>{{ $company->street }}</td>
            </tr>
            <tr>
                <th>NIP</th>
                <td>{{ $company->nip }}</td>
            </tr>
            <tr>
                <th>Email (login)</th>
                <td>{{ $company->email }}</td>
            </tr>
            <tr>
                <th>Telefon</th>
                <td>{{ $company->phone ?? '-' }}</td>
            </tr>
            <tr>
                <th>Kurs punktowy</th>
                <td>1 zł = {{ $company->exchange_rate }} pkt</td>
            </tr>
            <tr>
                <th>Podpisana umowa</th>
                <td>
                    @if ($company->agreement_file)
                        <a href="{{ asset('storage/'.$company->agreement_file) }}" target="_blank" class="btn btn-sm btn-primary">Pobierz</a>
                    @else
                        brak
                    @endif
                </td>
            </tr>
            <tr>
                <th>Regulamin</th>
                <td>
                    @if ($company->regulations_file)
                        <a href="{{ asset('storage/'.$company->regulations_file) }}" target="_blank" class="btn btn-sm btn-primary">Pobierz</a>
                    @else
                        brak
                    @endif
                </td>
            </tr>
            <tr>
                <th>Data rejestracji</th>
                <td>{{ $company->created_at }}</td>
            </tr>
        </table>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Powrót</a>
    </div>
@endsection
