<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activityLog extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'ip_address',
        'location',
        'user_agent',
        'description',
        'logged_at',
    ];

    protected $casts = [
        'logged_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}