<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class UserService extends Model
{
    protected $fillable=[
        'name', 'email', 'password'
    ];
}
