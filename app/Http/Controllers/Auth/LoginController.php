<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     */
    protected $redirectTo = '/'; // minimal change.

    public function __construct()
    {
        // minimal change.
        $this->middleware('guest')->except('logout');
    }
}
