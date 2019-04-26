<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TokenResetPassword extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'password_resets';

    protected $fillable = [
        'email', 'token', 
    ];
}
