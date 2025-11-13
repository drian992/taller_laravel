<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
     */
    protected $redirectTo = '/dashboard'; // minimal change.

    public function __construct()
    {
        // minimal change.
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        // minimal change.
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        // minimal change.
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, false)) {
            $request->session()->regenerate();

            return redirect()->intended($this->redirectPath());
        }

        throw ValidationException::withMessages([
            'email' => trans('auth.failed'),
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        // minimal change.
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function redirectPath(): string
    {
        $user = Auth::user();

        if ($user && $user->isAdmin) {
            return route('personas.index');
        }

        if ($user) {
            return route('dashboard');
        }

        return $this->redirectTo;
    }
}
