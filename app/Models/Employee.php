<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function contract()
    {
        return $this->hasOne(Contract::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($employee) {
            if ($employee->user) {
                $employee->user->delete();
            }
        });
    }
    protected $fillable = [
        'user_id',
        'nom',
        'prenom',
        'date_naissance',
        'email_professionnel',
        'email_personnel',
        'matricule',
        'telephone',
        'code_postal',
        'ville',
        'pays',
        'adresse',
        'situation_familiale',
        'nombre_enfants',
    ];
}

