<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // Nazwa tabeli
    protected $table = 'clients';

    // Klucz główny to UUID
    protected $keyType = 'string';
    public $incrementing = false;

    // Dozwolone pola do masowego wypełniania
    protected $fillable = [
        'id',
        'email',
        'postal_code',
        'city',
        'phone',
        'points_balance',
    ];
}
