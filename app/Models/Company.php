<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Company extends Authenticatable
{
    use Notifiable;

    protected $guard = 'company';

    protected $fillable = [
        'company_id',
        'name',
        'postal_code',
        'city',
        'street',
        'nip',
        'email',
        'phone',
        'password',
        'exchange_rate',
        'agreement_file',
        'regulations_file',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
