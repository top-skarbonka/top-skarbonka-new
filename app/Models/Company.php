<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // ważne: dziedziczymy jak "User"
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'postal_code',
        'city',
        'street',
        'nip',
        'email',
        'phone',
        'exchange_rate',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'exchange_rate' => 'decimal:2',
    ];
}
