<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consent extends Model
{
    protected $fillable = [
        'guid',
        'accepted_at',
        'decline_at',
        'version',
        'ip_address',
        'user_agent',
    ];

    protected $dates = [
        'accepted_at',
        'decline_at',
    ];
}
