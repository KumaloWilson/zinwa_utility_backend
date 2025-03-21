<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthToken extends Model
{
    protected $fillable = [
        'name',
        'token',
        'abilities',
    ];
}
