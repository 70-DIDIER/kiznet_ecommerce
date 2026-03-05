<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Subscriber extends Model
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'token', 'is_verified', 'verified_at'];

    protected $casts = [
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
    ];
}