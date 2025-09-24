@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2>Rejestracja nowej firmy</h2>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {!! session('success') !!}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.register.submit') }}">
        @csrf

        <div class="mb-3">
            <label>Nazwa firmy</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kod pocztowy</label>
            <input type="text" name="postal_code" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Miasto</label>
            <input type="text" name="city" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Ulica i nr</label>
            <input type="text" name="street" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>NIP</label>
            <input type="text" name="nip" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Telefon</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Zarejestruj firmę</button>
    </form>
</div>
@endsection
