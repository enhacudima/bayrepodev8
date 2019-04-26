<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use App\Helpers\LogActivity;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }




    public function logout() {

        LogActivity::addToLog('Acesso-Logout');
        Auth::logout();

        return view('welcome');

    }

    protected function hasTooManyLoginAttempts(Request $request)
    {   
        
       $maxLoginAttempts = 3;

       $lockoutTime = 1; // In minutes

       return $this->limiter()->tooManyAttempts(
           $this->throttleKey($request), $maxLoginAttempts, $lockoutTime
       );
    }
}
