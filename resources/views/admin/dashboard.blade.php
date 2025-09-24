@extends('admin.layout')

@section('title','Panel Administratora')

@section('content')
    <h1 class="mb-4">Panel Administratora</h1>

    <div class="row g-3">
        <div class="col-sm-6 col-lg-4">
            <div class="card shadow-sm p-3">
                <h5 class="mb-1">Firmy</h5>
                <div class="display-6 fw-bold">{{ $stats['companies'] }}</div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card shadow-sm p-3">
                <h5 class="mb-1">Klienci</h5>
                <div class="display-6 fw-bold">{{ $stats['clients'] }}</div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card shadow-sm p-3">
                <h5 class="mb-1">Transakcje</h5>
                <div class="display-6 fw-bold">{{ $stats['transactions'] }}</div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">➕ Zarejestruj nową firmę</a>
        <a href="{{ route('admin.companies.index') }}" class="btn btn-outline-secondary ms-2">📄 Lista firm</a>
    </div>
@endsection
