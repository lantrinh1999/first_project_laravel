<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $hidden = [
        'password',
    ];
    protected $table = 'users';
    protected $fillable = [
        'id',
        'name',
        'is_active',
        'email',
    ];

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'user_id', 'id');
    }
}
