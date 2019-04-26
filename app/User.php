<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\meuResetDeSenha;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Broadcasting\PrivateChannel;




class User extends Authenticatable
{
    
    use HasApiTokens, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password','level','user_id','phone','city','branch','username','lname','title','ticket_level',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

        /**

     * Get the cabecalho for the user post.

     */

    public function cabecalho()

    {

        return $this->hasMany('App\cabecalho');

    }

    public function sendPasswordResetNotification($token)

    {

        $this->notify(new meuResetDeSenha($token));

    }

    protected function hasTooManyLoginAttempts(Request $request)
    {
        $maxLoginAttempts = 2;
     
        $lockoutTime = 1; // In minutes
     
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $maxLoginAttempts, $lockoutTime
        );
    }
}
