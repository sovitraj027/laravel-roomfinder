<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    //   protected $redirectTo = RouteServiceProvider::HOME;

    public function redirectPath()
    {
        if (Auth::user()->admin) {
            return ('admin/dashboard');
        } elseif (Auth::user()->role == 1) {
            return ('owner/profile/' . Auth::user()->name);
        } elseif (Auth::user()->role == 2) {
            return ('seeker/profile/' . Auth::user()->name);
        } else {
            return ('/login');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
