<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    // Campos que se pueden llenar masivamente (create / update)
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Campos que no se muestran cuando se convierte a array/json
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Convierte automáticamente el password a hash
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}