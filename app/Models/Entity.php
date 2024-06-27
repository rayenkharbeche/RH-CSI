<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model

{
    protected $fillable = [
        'name',
        'tax_number',
        'address',
        'country',
        'contact_information',
        'employer_name',
        'employer_address',
        'siret_number',
        'ape_code',
        'collective_agreement',
        'establishment_id',
    ];
}
