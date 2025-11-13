<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /**
     * Where to redirect users after registration.
     */
    protected $redirectTo = '/dashboard'; // minimal change.

    public function __construct()
    {
        // minimal change.
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        // minimal change.
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        // minimal change.
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended($this->redirectPath());
    }

    protected function validator(array $data)
    {
        // minimal change.
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'dni' => [
                'required',
                'string',
                'max:30',
                Rule::unique('users', 'dni'),
                Rule::unique('personas', 'dni')->whereNull('deleted_at'),
            ],
            'telefono' => ['required', 'string', 'max:30'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
                Rule::unique('personas', 'email')->whereNull('deleted_at'),
            ],
            'direccion' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        // minimal change.
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['nombre'],
                'nombre' => $data['nombre'],
                'dni' => $data['dni'],
                'domicilio' => $data['direccion'],
                'telefono' => $data['telefono'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'user',
                'profile_locked' => true,
            ]);

            Persona::create([
                'user_id' => $user->id,
                'nombre' => $data['nombre'],
                'dni' => $data['dni'],
                'telefono' => $data['telefono'],
                'email' => $data['email'],
                'direccion' => $data['direccion'],
            ]);

            return $user;
        });
    }

    protected function redirectPath(): string
    {
        // minimal change.
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
