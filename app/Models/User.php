<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'otp', 'otp_expires_at', 'email_verified_at'
    ];

    protected $hidden = ['password', 'remember_token'];
}