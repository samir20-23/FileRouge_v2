<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; 
use Illuminate\Foundation\Auth\AuthenticatesUsers; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

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

      protected function redirectTo(): string
    { 
        $role = Auth::user()->role;

        if (strtolower($role) === 'admin') {
            return route('dashboard');
        }

        // default to 'home' for any non-admin
        return route('home');
    }


    public function __construct()
    {

        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
